import cv2
import face_recognition
import os
import numpy as np

#carregar codificações e nomes de classe

def load_encodings (encodings_path):
    encodings = []
    class_names = []
    for file in os.listdir(encodings_path):
        if file.endswith("_encoding.npy"):
            class_name = file.split('_')[0]
            encoding = np.load(os.path.join(encodings_path, file))
            encodings.append(encoding)
            class_names.append(class_name)
    return encodings,class_names


#path for saved encoding
encodings_path = 'faces'
known_encodings, class_names = load_encodings(encodings_path)
print(f"loaded classes:{class_names}")

# Initialize video capture
cap = cv2.VideoCapture(0)

scale = 0.25  # Downscale for performance  
cap = cv2.VideoCapture(0)  
