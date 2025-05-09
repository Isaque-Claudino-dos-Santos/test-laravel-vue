import { Axios, AxiosError } from "axios";

export default class AxiosBuilder {
    private _url?: string;
    private _method?: string;
    private _payload: unknown;
    private _params: unknown;
    private _bearer: string;

    constructor(private readonly axios: Axios) {}

    static build(axios: Axios): AxiosBuilder {
        return new AxiosBuilder(axios);
    }

    get(url: string) {
        this._url = url;
        this._method = "get";
        return this;
    }

    post(url: string) {
        this._url = url;
        this._method = "post";
        return this;
    }

    bearer(token: string) {
        this._bearer = token;
        return this;
    }

    payload<T>(value: T) {
        this._payload = value;
        return this;
    }

    params<T>(value: T) {
        this._params = value;
        return this;
    }

    async fetch<T>() {
        const requestOptions = {
            url: this._url,
            method: this._method,
            data: this._payload,
            params: this._params,
            headers: {},
        };

        if (!!this._bearer) {
            requestOptions["headers"][
                "Authorization"
            ] = `Bearer ${this._bearer}`;
        }

        try {
            const response = await this.axios.request(requestOptions);

            return response.data as T;
        } catch (err) {
            if (err instanceof AxiosError) {
                //TODO: handle error
            }
        }

        return null;
    }
}
