#!/usr/bin/env python
from cv2 import cv2
# import cv2
import os
import sys

def detect_faces(f_cascade, img, scaleFactor = 1.1,needGray=False):
    sub_face = None
    if needGray:
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    else:
        gray = img
    faces = f_cascade.detectMultiScale(gray, scaleFactor=scaleFactor, minNeighbors=1)
    for (x, y, w, h) in faces:
        sub_face = gray[y+2:y+h-2, x+2:x+w-2]
    
    return sub_face


if __name__=="__main__":
    haar_face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_alt.xml')
    
    nmFile=sys.argv[1]
    dim=96
    img = cv2.imread(nmFile)
    face= True
    if img is None:
        os.system('del %s'%nmFile)
        face=False
    else:
        aligned_img = detect_faces(haar_face_cascade,img) 
        if aligned_img is None:
            os.system('del %s'%nmFile)
            face=False
    if face == True:
        print("ACCEPTED")
    else:
        print("REJECTED, not face no remove , no add to repository  ")
        os.system('del %s'%nmFile)

        
