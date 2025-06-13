from conexao import criar_conexao, fechar_conexao

def test(con,id,localizacao,nome,n_de_serie):
    cursor = con.cursor()
    sql = "INSERT INTO dispositivo(id,localizacao,nome,n_de_serie ) values(%s,%s,%s,%s)"
    valores =(id,localizacao,nome,n_de_serie)
    cursor.execute(sql,valores)
    cursor.close()
    con.commit()
    

def main():
    print('a')

    con =  criar_conexao("localhost","root","serra","smartcam")
    print('a')

    test(con,1,"sala","celula",1)
    print('a')

    fechar_conexao(con)
    print('a')

if __name__ == "__main__":
    main()
    