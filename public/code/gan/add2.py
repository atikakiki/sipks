#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Sun Dec 13 15:35:53 2020

@author: dwi
"""
import os
import matplotlib.pyplot as plt
from libs import utils,datasets,gif
from skimage.transform import resize
import numpy as np
from libs import celeb_vaegan as CV
import tensorflow as tf
#tf.disable_v2_behavior()
from scipy.ndimage import gaussian_filter
import face_recognition
import cv2

def get_features_for(feature_img_directory='./FacesWithGlasses/', n_imgs=100):
    
    files = [os.path.join(feature_img_directory, fname)
             for fname in os.listdir(feature_img_directory)]
    
    files = files[:n_imgs]
    
    feature_imgs = [plt.imread(files[img_i])
        for img_i in range(len(files))]
    
    # Crop every image to a square
    feature_imgs = [utils.imcrop_tosquare(img_i) for img_i in feature_imgs]
    
    # Then resize the square image to 100 x 100 pixels
    feature_imgs = [resize(img_i, (100, 100)) for img_i in feature_imgs]

    preprocessed = np.array([CV.preprocess(img_i) for img_i in feature_imgs])
    zs = sess.run(Z, feed_dict={X: preprocessed})
    
    return np.mean(zs, 0)

def getFace(img):
    face_bounding_boxes = face_recognition.face_locations(img)
    if len(face_bounding_boxes) != 1:
        return None
    for face_location in face_bounding_boxes:
        top, right, bottom, left = face_location
        face_image = img[top:bottom, left:right]    
    return face_image

#from deepface import DeepFace

if __name__ == '__main__':
    sess = tf.Session()
    g = tf.get_default_graph()
    net = CV.get_celeb_vaegan_model()
    files = datasets.CELEB()
    #tambahan
    #fi = cv2.imread(files)
    celeb_files = files.copy()

    tf.import_graph_def(net['graph_def'], name='net', input_map={
        'encoder/variational/random_normal:0': np.zeros(512, dtype=np.float32)})
    
    X = g.get_tensor_by_name('net/x:0')
    Z = g.get_tensor_by_name('net/encoder/variational/z:0')
    G = g.get_tensor_by_name('net/generator/x_tilde:0')

    # The mean eyeglasses using the new 'get_features_for' function
    z1 = get_features_for(feature_img_directory='./FacesWithGlasses/')
    # The generated eyeglasses feature through the VGG network.
    print(z1[np.newaxis].shape)
    feature_generated = sess.run(G, feed_dict={Z: z1[np.newaxis]})
    plt.imshow(feature_generated[0] / feature_generated.max())
    
    
    # Mean of faces with no glasses or hats.
    z2 = get_features_for(feature_img_directory='./img_align_celeba/', n_imgs=100)
    print(z2[np.newaxis].shape)
    feature_generated = sess.run(G, feed_dict={Z: z2[np.newaxis]})
    plt.imshow(feature_generated[0] / feature_generated.max())
    
    # # IV- Putting features on faces¶
    # # Now we will use generated features above to create vectors and put them on the faces.

    # # Remove the generated mean face (people without eyeglass) from the generated eyeglasses feature
    glass_vector = z1 - z2
    print(glass_vector[np.newaxis].shape)
    generated_glass_vector = sess.run(G, feed_dict={Z: glass_vector[np.newaxis]})
    plt.imshow(generated_glass_vector[0] / generated_glass_vector.max())
    
    
    idxs = np.random.permutation(range(len(celeb_files)))
    imgs = [plt.imread(celeb_files[idx_i]) for idx_i in idxs[:100]]
    blurred = []
    for img_i in imgs:
        img_copy = np.zeros_like(img_i)
        for ch_i in range(3):
            img_copy[..., ch_i] = gaussian_filter(img_i[..., ch_i], sigma=3.0)
        blurred.append(img_copy)
        
        
    # Now let's preprocess the original images and the blurred ones
    imgs_p = np.array([CV.preprocess(img_i) for img_i in imgs])
    blur_p = np.array([CV.preprocess(img_i) for img_i in blurred])
    
    # And then compute each of their latent features
    noblur = sess.run(Z, feed_dict={X: imgs_p})
    blur = sess.run(Z, feed_dict={X: blur_p})
    
    synthetic_unblur_vector = np.mean(noblur - blur, 0)
    
    # Let's randomly choose a set of 100 faces on the Celeb dataset and try apply the effect of the glass_vector on.
    
    #idxs = np.random.permutation(range(len(files)))
    #imgs = [plt.imread(files[idx_i]) for idx_i in idxs[:100]]
    #imgs_p = np.array([CV.preprocess(img_i) for img_i in imgs])
    idxs = np.random.permutation(range(len(celeb_files)))
    imgs = [plt.imread(celeb_files[idx_i]) for idx_i in idxs[:100]]
    imgs_p = np.array([CV.preprocess(img_i) for img_i in imgs])
    # Or only the line below
    #imgs_p = np.array([CV.preprocess(img_i) for img_i in vgg_imgs])
    print("size celeb_files : ", len(celeb_files))
    
    z = sess.run(Z, feed_dict={X: imgs_p})
    
    n_imgs = 5
    amt = np.linspace(0, 1, n_imgs)
    imgs = []
    for amt_i in amt:
        zs = z + synthetic_unblur_vector * amt_i + amt_i * glass_vector + amt_i * glass_vector 
        #zs = z + amt_i * glass_vector + amt_i * glass_vector 
        g = sess.run(G, feed_dict={Z: zs})
        m = utils.montage(np.clip(g, 0, 1))
        imgs.append(m)
        
    gif.build_gif(imgs=imgs, saveto='final_project_glass.gif')
    # Let's pick the first 100 images of the celeb dataset and pick one for the process
    imgs = [plt.imread(celeb_files[idx_i])/255.0 for idx_i in range(100)]
    m = utils.montage(imgs, 'imgs/100_celeb_images.png')
    plt.figure(figsize=(10, 10))
    plt.imshow(m)
    
    # Index of the selected image, we pick here the sixth image (index 5)
    img = imgs[15]
    
    img = CV.preprocess(img, crop_factor=1.0)[np.newaxis]
    
    img_ = sess.run(G, feed_dict={X: img})
    fig, axs = plt.subplots(1, 2, figsize=(10, 5))
    axs[0].imshow(img[0]), axs[0].grid('off')
    axs[0].set_title('Original Image')
    axs[1].imshow(np.clip(img_[0] / np.max(img_), 0, 1)), axs[1].grid('off')
    axs[1].set_title('Generated Image')
    
    # According to the nb_iteration and the linspace we could have very different results
    # We have to tune fine to get something very cool.
    
    z = sess.run(Z, feed_dict={X: img})
    n_imgs = 5
    #amt = np.linspace(-1.5, 2.5, n_imgs)
    #amt = np.linspace(0, 1, n_imgs)
    amt = np.linspace(-1.5, 2.5, n_imgs)
    
    nb_iteration = 2
    
    # We first put the selected image in the list for future comparison
    img_list = [plt.imread(celeb_files[15])]
    #img_list = []
    
    for amt_i in amt:
        
        i=0
        while i < nb_iteration:
            if i==0:
                z += synthetic_unblur_vector * amt_i
            else:
                #z += amt_i * hat_vector 
                z += amt_i * glass_vector
            i += 1
            
        zs = z
        
        
        g = sess.run(G, feed_dict={Z: zs})
        m = utils.montage(np.clip(g, 0, 1))
        img_list.append(m)    
    
    print(len(img_list))
    plt.imshow(img_list[5])
    
    
    gif.build_gif(imgs=img_list, saveto='final_project_glasses_one.gif')
    
    # ipyd.Image(url='final_project_glasses_one.gif?i={}'.format(
    #         np.random.rand()), height=200, width=200)
    
    # Let's compare the original image with the generated ones.
    fig, axs = plt.subplots(1, len(img_list), figsize=(20, 4))
    for i, ax_i in enumerate(axs):
        ax_i.imshow(img_list[i])
        ax_i.grid('off')
        ax_i.axis('off')
        
    # According to the nb_iteration and the linspace we could have very different results
    # We have to tune fine to get something very cool.
    
    z = sess.run(Z, feed_dict={X: img})
    n_imgs = 5
    #amt = np.linspace(-1.5, 2.5, n_imgs)
    #amt = np.linspace(0, 1, n_imgs)
    amt = np.linspace(-1.5, 2.5, n_imgs)
    
    nb_iteration = 2
    
    # We first put the selected image in the list for future comparison
    img_list = [plt.imread(celeb_files[5])]
    
    for amt_i in amt: 
        i=0
        while i < nb_iteration:
            if i==0:
                z += synthetic_unblur_vector * amt_i
            else:
                # z += amt_i * glass_vector + amt_i * hat_vector * 0.8
                z += amt_i * glass_vector

            i += 1
            
        zs = z
        
        g = sess.run(G, feed_dict={Z: zs})
        m = utils.montage(np.clip(g, 0, 1))
        img_list.append(m)    
    
    print(len(img_list))
    #plt.imshow(img_list[3])
    
    gif.build_gif(imgs=img_list, saveto='final_project_glasses_hats_one.gif')
    
    # Let's compare the original image with the generated ones.
    fig, axs = plt.subplots(1, len(img_list), figsize=(20, 4))
    for i, ax_i in enumerate(axs):
        ax_i.imshow(img_list[i])
        ax_i.grid('off')
        ax_i.axis('off')

    img_list=[]
    nmFile='1-1.jpeg'       
    img_jc = plt.imread(nmFile)[..., :3]
    # img_jc = getFace(img_jc)
    #img = imgs[32]
    img_jc = CV.preprocess(img_jc, crop_factor=1.0)[np.newaxis]
    
    img_ = sess.run(G, feed_dict={X: img_jc})
    fig, axs = plt.subplots(1, 2, figsize=(10, 5))
    axs[0].imshow(img_jc[0]), axs[0].grid('off')
    axs[0].set_title('Original Image')
    axs[1].imshow(np.clip(img_[0] / np.max(img_), 0, 1)), axs[1].grid('off')
    axs[1].set_title('Generated Image')
    
    # According to the nb_iteration and the linspace we could have very different results
    # We have to tune fine to get something very cool.
    
    z = sess.run(Z, feed_dict={X: img_jc})
    n_imgs = 5
    amt = np.linspace(-1.5, 2.5, n_imgs)
    # zs = np.array([z[0] + hat_vector * amt_i for amt_i in amt])
    
    nb_iteration = 2
    
    # We first put the selected image in the list for future comparison
    img_list = [plt.imread(nmFile)[..., :3]]
    #img_list = []
    
    for amt_i in amt:
        
        i=0
        while i < nb_iteration:
            if i==0:
                z += synthetic_unblur_vector * amt_i
            else:
                #z += amt_i * hat_vector 
                # z += amt_i * glass_vector + amt_i * hat_vector * 0.5
                z += amt_i * glass_vector

            i += 1
            
        zs = z
        
        g = sess.run(G, feed_dict={Z: zs})
        m = utils.montage(np.clip(g, 0, 1))
        img_list.append(m)    
    
        
    # Let's compare the original image with the generated ones.
    fig, axs = plt.subplots(1, len(img_list), figsize=(20, 4))
    for i, ax_i in enumerate(axs):
        ax_i.imshow(img_list[i])
        ax_i.grid('off')
        ax_i.axis('off')