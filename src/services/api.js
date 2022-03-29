function getOptions(options){
    const authToken = 'Bearer 1647692835tUVxuFjuek6xEj8JHPlsWlHN7aGHz6uBwHS8PcxThuTkPLrEJA4xgKg';

    if(authToken) return {...options, headers:{'Authorization' : authToken}};
    return {...options};
}
function api(url,options,callback){
    const apiurl = 'http://localhost:8000/api/' + url;
    
    fetch(apiurl,getOptions(options)).then(response => response.json()).then(
        result => callback(result),
        error => console.debug(error)
    );
}

export default api;