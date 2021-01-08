# from imutils import paths
import face_recognition
import pickle
import cv2
import os
import sys
 

def checkDirectory(filename):
    if not os.path.exists(os.path.dirname(filename)):
        try:
            os.makedirs(os.path.dirname(filename))
        except OSError as exc: # Guard against race condition
            if exc.errno != errno.EEXIST:
                raise
#get paths of each file in folder named Images
#Images here contains my data(folders of various persons)
id_usr = sys.argv[1]
# imagePaths = list(paths.list_images('C:\\xampp\\htdocs\\sipks_ta\\public\\uploadFace\\' + id_usr))
imagePaths = "C:\\xampp\\htdocs\\sipks_ta\\public\\uploadFace\\" + id_usr
knownEncodings = []
knownNames = []
# loop over the image paths

for imagePath in os.listdir(imagePaths):
    # extract the person name from the image path
    name = id_usr
    # load the input image and convert it from BGR (OpenCV ordering)
    # to dlib ordering (RGB)
    image = cv2.imread(imagePath)
    rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    #Use Face_recognition to locate faces
    boxes = face_recognition.face_locations(rgb,model='hog')
    # compute the facial embedding for the face
    encodings = face_recognition.face_encodings(rgb, boxes)
    # loop over the encodings
    for encoding in encodings:
        knownEncodings.append(encoding)
        knownNames.append(name)
#save emcodings along with their names in dictionary data
data = {"encodings": knownEncodings, "names": knownNames}
#use pickle to save data into a file for later use
pathDEST = "C:\\xampp\\htdocs\\sipks_ta\\public\\trainedFace\\%s_%s"%(nrp,now.strftime("%Y_%m_%d_%H_%M_%S"))
checkDirectory(pathDEST)
os.system('move %s %s'%(imagePaths,pathDEST)) 
f = open("face_enc", "wb")
f.write(pickle.dumps(data))
f.close()