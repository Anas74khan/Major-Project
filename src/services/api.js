function getOptions(options){
    const authToken = window.localStorage.getItem('authToken');
    
    let headers ={
        "Content-Type": "application/json",
        "Accept": "application/json"
    };

    if(authToken) headers = {...headers, 'Authorization' : `Bearer ${authToken}`};
    return {...options, headers};
}
function api(url,options,callback){
    const apiurl = 'http://localhost:8000/api/' + url;
    
    fetch(apiurl,getOptions(options)).then(response => response.json()).then(
        result => callback(result),
        error => console.debug(error)
    );
}

export default api;