import mysql.connector
def criar_conexao():
    try:
        conexao = mysql.connector.connect(host='localhost',port=3306,user='root',password='usbw',database='smartcam' )
        return conexao
    except mysql.connector.Error as erro:
        print(f"Erro ao conectar ao MySQL: {erro}")
        return None
    
def fechar_conexao(con):
    con.close()