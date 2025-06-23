import face_recognition
import cv2
import pass_1 

# Carrega imagem
imagem = face_recognition.load_image_file( "../root/rostos/pessoa.jpg")

# Detecta rosto(s)
locais_rosto = face_recognition.face_locations(imagem)

# Converte imagem para BGR (para OpenCV)
imagem_bgr = cv2.cvtColor(imagem, cv2.COLOR_RGB2BGR)

# Desenha retângulo em cada rosto encontrado
for (top, right, bottom, left) in locais_rosto:
    cv2.rectangle(imagem_bgr, (left, top), (right, bottom), (0, 255, 0), 2)

# Mostra imagem
cv2.imshow("Rostos detectados", imagem_bgr)
cv2.waitKey(0)
cv2.destroyAllWindows()
