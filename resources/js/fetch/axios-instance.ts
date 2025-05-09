import axios from "axios";


export const apiAxios = axios.create({
    url: 'http://localhost:8080',
    headers: {
        'accept': 'application/json'
    }
})
