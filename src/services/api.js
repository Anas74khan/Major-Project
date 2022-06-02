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
        result => {
            if(result.user) window.localStorage.setItem('user', JSON.stringify(result.user));
            callback(result);
        },
        error => console.debug(error)
    );
}

function isLoggedIn(){
    const user = JSON.parse(window.localStorage.getItem('user'));
    if(user && user.username.length > 3) return true;
    return false;
}
function userDetails(){
    return JSON.parse(window.localStorage.getItem('user'));
}

export {api, isLoggedIn, userDetails};