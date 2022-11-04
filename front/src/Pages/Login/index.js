import React, { useState } from 'react';
import { useHistory, Link } from 'react-router-dom';
import axios from 'axios';
import { Container, Form, Label, Input, LabelError, Button, LabelRegister, Strong } from './styles';


function Login() {
    const history = useHistory();
    const [email, setEmail] = useState();
    const [senha, setSenha] = useState();
    const [error, setError] = useState();

    const submitLogin = (e) => {
        e.preventDefault();
        if (!email | !senha) {
            setError("Preencha todos os campos");
            return;
        }
        
        const data ={
            email: email,
            password: senha ,
        }
       // console.log(data);
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post('/api/login', data).then(res => {
              if (res.data.status === 200) {
      
                localStorage.setItem('auth_token', res.data.token);
                localStorage.setItem('auth_nome', res.data.username);
                alert("Usuário Autenticado com Sucesso")
                history.push('/');
      
              } else if(res.data.status === 401) {
                alert("Credenciais Invalidas",res.data.message,"warning");
                
              } else{
                setError({...error, error_list: res.data.validation_errors  }); 
              }
              
            });
          });
      
        }


    return (
        <Container>
            <Label>Faça o seu Login</Label>
            <Form onSubmit={submitLogin}>
                <Input
                    type='email'
                    placeholder='Digite seu e-mail'
                    value={email}
                    onChange={(e) => [setEmail(e.target.value), setError("")]}
                />

                <Input
                    type='password'
                    placeholder='Digite sua senha'
                    value={senha}
                    onChange={(e) => [setSenha(e.target.value), setError("")]}
                />
                <LabelError>{error}</LabelError>
                <Button type='submit'>Entrar</Button>
                <LabelRegister>
                    Não tem uma conta?
                    <Strong>
                        <Link to="/register">&nbsp;Registre-se</Link>
                    </Strong>
                </LabelRegister>

            </Form>
        </Container>
    )

}

export default Login