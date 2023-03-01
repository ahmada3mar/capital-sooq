import axios from 'axios';
import VueRouter from 'vue-router';

const baseDomain = 'http://sooq.jo/api';
// console.log(window.location.hostname)

export const customHeaders = {
    'Content-Type': 'application/json',
    Accept: 'application/json',
};

export const baseUrl = `${baseDomain}`;

const axiosIns = axios.create( {
    baseURL:baseUrl,
    headers: customHeaders
} );

axiosIns.interceptors.response.use(response=>response ,error=>{
    const response = error.response
    if(response && response.status == 406){
        $nuxt._router.push('/pages/coming-soon')
    }
})
export default axiosIns
