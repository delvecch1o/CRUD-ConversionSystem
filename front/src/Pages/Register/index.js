import axios from 'axios';
import React, { useState } from 'react';
import { useHistory, Link } from 'react-router-dom';
import { Container, Form, Label, Input, LabelError, Button, LabelLogin, Strong } from './styles';

function Register() {

const history = useHistory();
const [nome, setNome] = useState();
const [email, setEmail] = useState();
const [senha, setSenha] = useState();
const [emailConfirme, setEmailConfirme] = useState();
const [error, setError] = useState();

const submitRegister = (e) => {
    e.preventDefault();
        if (!email | !emailConfirme | !senha) {
        setError("Preencha todos os campos");
        return;
        } else if(email !== emailConfirme ){
        setError("Os e-mails não são iguais");
        return; 
        } 
        

    const data ={
        name: nome,
        email: email,
        password: senha,
    }
   // console.log(data);
    axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/api/register', data).then(res => {
          if (res.data.status === 200) {
  
            localStorage.setItem('auth_token', res.data.token);
            localStorage.setItem('auth_nome', res.data.username);
            alert("Usuario Cadastrado Com Sucesso!")
            history.push('/');
  
          } else {
            setError({ ...error, error_list: res.data.validation_errors });
          }
  
        });
      });
  
    }


    return (
        <Container>
            <Label>Faça o seu Cadastro</Label>
            <Form onSubmit={submitRegister} >
            <Input
                    type='text'
                    placeholder='Digite seu nome'
                    value={nome}
                    onChange={(e) => [setNome(e.target.value), setError("")]}
                />
                <Input
                    type='email'
                    placeholder='Digite seu e-mail'
                    value={email}
                    onChange={(e) => [setEmail(e.target.value), setError("")]}
                />

                <Input
                    type="email"
                    placeholder="Confirme seu E-mail"
                    value={emailConfirme}
                    onChange={(e) => [setEmailConfirme(e.target.value), setError("")]}
                />

                    <Input
                    type='password'
                    placeholder='Digite sua senha,minimo 8'
                    value={senha}
                    onChange={(e) => [setSenha(e.target.value), setError("")]}
                />

                <LabelError>{error}</LabelError>
                <Button type='submit'>Registre-se</Button>
                <LabelLogin>
                    Já possui uma conta?
                    <Strong>
                        <Link to="/login">&nbsp;Entre</Link>
                    </Strong>
                </LabelLogin>
            </Form>
        </Container>
    )

}

export default Register