import React from 'react';
import { BrowserRouter as Router, Route, Switch, Redirect } from 'react-router-dom';
import axios from 'axios';
import RoutesPrivate from './privateRoutes';

import Register from '../Pages/Register';
import Login from '../Pages/Login';
import Home from '../Pages/Home'
import Temperature from '../Pages/TemperatureConverter';
import Coin from '../Pages/CoinConverter';
import Report from '../Pages/ReportConverter';



axios.defaults.baseURL = "http://localhost:8000";
axios.defaults.headers.post['Content-Type'] = 'application/json';
axios.defaults.headers.post['Accept'] = 'application/json';

axios.defaults.withCredentials = true;

axios.interceptors.request.use(function (config) {
const token = localStorage.getItem('auth_token');
config.headers.Authorization = token ? `Bearer ${token}` : '';
return config;
});

function App() {
return (
    <div>
        <Router>
            <Switch>

                <RoutesPrivate exact path="/" render={Home} />
                <RoutesPrivate exact path="/temperature" render={Temperature} />
                <RoutesPrivate exact path="/coin" render={Coin} />
                <RoutesPrivate exact path="/report" render={Report} />
                
                <Route path="/login">{localStorage.getItem('auth_token') ? <Redirect to='/' /> : <Login />}</Route>
                <Route path="/register">{localStorage.getItem('auth_token') ? <Redirect to='/' /> : <Register />}</Route>

                <Route path="*" component={Login} />

            </Switch>
        </Router>
    </div>

)
}

export default App;