# -*- coding: utf-8 -*-
"""
Created on Sun Dec 13 12:47:40 2020

@author: Admin
"""
from keras.applications.mobilenet import MobileNet
DIM=224
IMG_DIM = (DIM, DIM)
input_shape = (DIM, DIM, 3)
import keras
from keras.models import Model
import os,cv2
import numpy as np
from sklearn.linear_model import LogisticRegression
import pickle,sys
import time
import errno
from datetime import datetime

def createMobileNet():
    mobileNet =  MobileNet(include_top=False, weights='imagenet', 
                                     input_shape=input_shape)

    output    = mobileNet.layers[-1].output
    output    = keras.layers.Flatten()(output)
    ModelmobileNet = Model(inputs=mobileNet.input, outputs=output)# base_model.get_layer('custom').output)

    ModelmobileNet.trainable = False
    for layer in ModelmobileNet.layers:
        layer.trainable = False
    return ModelmobileNet

def detect_faces(f_cascade, img, scaleFactor = 1.1,needGray=False):
    sub_face = None
    if needGray:
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    else:
        gray = img
    faces = f_cascade.detectMultiScale(gray, scaleFactor=scaleFactor, minNeighbors=1);
    for (x, y, w, h) in faces:
        sub_face = gray[y+2:y+h-2, x+2:x+w-2]
    
    return sub_face

def checkDirectory(filename):
    if not os.path.exists(os.path.dirname(filename)):
        try:
            os.makedirs(os.path.dirname(filename))
        except OSError as exc: # Guard against race condition
            if exc.errno != errno.EEXIST:
                raise


if __name__ == '__main__':
    t = time.time()
    
    haar_face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_alt.xml')
    nrp_list = []
    ftr_list = []
    nrp=sys.argv[1]
    # nrp = '20191031082240'
    # nrp = '05111740000007'
    # nrp = 05111640000042

    path = "C:\\xampp\\htdocs\\sipks\\public\\uploadFace\\" + nrp

    ModelmobileNet = createMobileNet()
    
    for imgFile in os.listdir(path):
        nmFile = path + "\\" + imgFile
        img = cv2.imread(nmFile)
        img = cv2.resize(img, IMG_DIM)
        img = detect_faces(haar_face_cascade,img)
        if img is None:
            print("face not detected %s"%nmFile)
            continue
        img = cv2.resize(img, IMG_DIM)
        img=img/255
        img=img.reshape(1,img.shape[0],img.shape[1],img.shape[2])
        features = ModelmobileNet.predict(img, verbose=0)

        ftr_list.append(features)
        nrp_list.append(nrp)
    
    nrp_np = np.array(nrp_list)
    ftr_np = np.array(ftr_list)
    ftr_np = ftr_np.reshape(ftr_np.shape[0],ftr_np.shape[2])
    nmFILE = "face.npz"
    if os.path.exists(nmFILE):
        dataLoaded = np.load(nmFILE)
        ftr_np_old=dataLoaded['ftr_np']
        nrp_np_old  =dataLoaded['nrp_np']
        ftr_np = np.concatenate((ftr_np,ftr_np_old),axis=0)
        nrp_np = np.concatenate((nrp_np,nrp_np_old),axis=0)
    print("saving to %s file "%(nmFile))
    np.savez_compressed(nmFILE,nrp_np=nrp_np,ftr_np=ftr_np)
    print("Selesai ...")
    #
    now = datetime.now()
    pathDEST = "C:\\xampp\\htdocs\\sipks\\public\\trainedFace\\%s_%s"%(nrp,now.strftime("%Y_%m_%d_%H_%M_%S"))

    checkDirectory(pathDEST)
    os.system('move %s %s'%(path,pathDEST))        
    
    if len(np.unique(nrp_np)) ==1:
        print("Labels only one class, cant create model")
    else:
        modelLR = LogisticRegression(solver='lbfgs',n_jobs=-1, multi_class='auto',tol=0.8)
        modelLR.fit(ftr_np,nrp_np)
        with open('modelTR.pkl', 'wb') as f:
            pickle.dump(modelLR, f)
            elapsed = time.time() - t
        print ("Save Model succeded Time Elapsed = %g"%elapsed)        
    

    
    