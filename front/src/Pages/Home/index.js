import React, {Link} from 'react';
import axios from 'axios';
import { useHistory } from 'react-router-dom';
import { Container } from './styles';
import Header from '../../Components/Header/index'

function Home(){
    return(
        <div>
            <Header />  
            <h1>Home page</h1>
        </div>   
    )
}

export default Home