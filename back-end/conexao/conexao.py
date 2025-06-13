import mysql.connector
def criar_conexao(host, usuario, senha, banco):
    try:
        conexao = mysql.connector.connect(host=host,port=3306,user=usuario,password=senha,database=banco )
        return conexao
    except mysql.connector.Error as erro:
        print(f"Erro ao conectar ao MySQL: {erro}")
        return None
    
def fechar_conexao(con):
    if con is not None:
        con.close()
        print("Conexão fechada.")
