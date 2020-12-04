// in src/authProvider.js
import { AUTH_LOGIN, AUTH_CHECK, AUTH_LOGOUT,AUTH_ERROR  } from 'react-admin';

const api_url = process.env.REACT_APP_API_URL

export default (type, params) => {
    if (type === AUTH_LOGIN) {
        const { username, password } = params;
        const request = new Request(api_url+'/users/login', {
            method: 'POST',
            body: JSON.stringify({ username, password }),
            headers: new Headers({ 'Content-Type': 'application/json' }),
        })
        return fetch(request)
            .then(response => {
                if (response.status < 200 || response.status >= 300) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .then(({ data }) => {
                const {token, role, name} = data
                localStorage.setItem('token', token);
                localStorage.setItem('role', role);
                localStorage.setItem('name', name);
            });
    }

    if(type===AUTH_LOGOUT){
        localStorage.removeItem('token');
        localStorage.removeItem('role');
        localStorage.removeItem('name');
        return Promise.resolve();
    }

    if (type === AUTH_ERROR) {
        // const status  = params.status;
        // console.log("auth error",params)
        // if (status === 401 || status === 403) {
        //     localStorage.removeItem('token');
        //     return Promise.reject();
        // }

        //just reject to login page
        // localStorage.removeItem('token');
        // localStorage.removeItem('role');
        // localStorage.removeItem('name');
        // return Promise.reject();
       return Promise.resolve();
    }

    if (type === AUTH_CHECK) {
        // const routeParams  = params.routeParams;
        //console.log("auth check",params)
        return localStorage.getItem('token')  ? Promise.resolve() : Promise.reject();
    }

    return Promise.reject('Unknown method');
}