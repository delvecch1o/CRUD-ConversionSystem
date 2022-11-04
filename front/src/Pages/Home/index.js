import React, {Link} from 'react';
import axios from 'axios';
import { useHistory } from 'react-router-dom';

function Home(){
    const history = useHistory();
    
    const logoutSubmit = (e) =>{
        e.preventDefault();

        axios.post('/api/logout').then(res => {
            if (res.data.status === 200) {

                localStorage.removeItem('auth_token');
                localStorage.removeItem('auth_name');
                alert("Sucesso", res.data.message, "Sucesso");
                history.push('/login');

            } 
        });
    }
    
    var AuthButtons = '';
    if(!localStorage.getItem('auth_token'))
    {
        AuthButtons = (
            <ul>
                <li>
                    <Link to="/login">Login</Link>
                </li>
                <li>
                    <Link to="/register">Register</Link>
                </li>
            </ul>
        )
    }
    else
    {
        AuthButtons = (
            <li>
                <button type="button" onClick={logoutSubmit}>Sair</button>
            </li>
        )
    }

    return(
        <div>
            <h1>Home Page</h1>
            {AuthButtons}
        </div>
    )
}

export default Home