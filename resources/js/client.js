import axios from 'axios'


export const client = axios.create({
    // baseURL: 'http://localhost:8081',
    json: true,
})
export default {
    async call(method, resource, data) {
        return client({
            method,
            url: resource,
            data,
            headers: { Accept: 'application/json',}
        })
        .then(request => { return request})
        .catch(error => {
            if (error.response.status === 208){
                window.location.reload()
            } else if (error.response.status === 422){
                alertify.warning(error.response.statusText + '!' + error.response.data.message)
                let errorFields = Object.keys(error.response.data.errors);
                console.log(error.response.data.errors)
                errorFields.map(field => {
                    let errorString = error.response.data.errors[field].join(', ');
                    alertify.warning(field +' - '+errorString)
                    v.errors.add({
                        field: field,
                        message: errorString,
                        scope: 'unique',
                    });
                });
                return error.response;
            }else if (error.response.status === 400) {
                alertify.warning(error.response.status + '!' + error.response.data.message)
            } else if (error.response.status === 404){
                alertify.warning(error.response.statusText + '!' + error.response.data.message)
            } else if (error.response.status >= 400 && error.response.status < 500){
                alertify.warning(error.response.statusText + ' ! Client Error')
                if (error.response.status === 401) {
                    window.location.replace('/login')
                }

            } else if (error.response.status >= 500){
                alertify.error(error.response.statusText + ' ! Server Error')
            }
        })
    },
    post (url, data = null){
        return this.call('post', url, data);
    },
    get (url, data = null){
        return this.call('get', url, data);
    },
    put (url, data = null){
        return this.call('put', url, data);
    },
    delete (url, data = null){
        return this.call('delete', url, data);
    }
}
