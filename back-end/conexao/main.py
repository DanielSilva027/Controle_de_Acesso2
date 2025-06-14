from conexao import criar_conexao, fechar_conexao

def test(con,localizacao,nome,n_de_serie):
    cursor = con.cursor()
    sql = "INSERT INTO dispositivo(localizacao,nome,n_de_serie ) values(%s,%s,%s)"
    valores =(localizacao,nome,n_de_serie)
    cursor.execute(sql,valores)
    cursor.close()
    con.commit()
    

def main():
    print('a')

    con =  criar_conexao("localhost","root","usbw","smartcam")
    print('a')

    test(con,"sala","celula",1)
    print('a')

    fechar_conexao(con)
    print('a')

if __name__ == "__main__":
    main()
    