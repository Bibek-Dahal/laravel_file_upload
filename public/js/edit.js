function handleChange(event){
    console.log(event.target.value);
    console.log('hello i am called');
    document.getElementsByClassName('img-viewer').src = event.target.value;
    console.log(document.getElementsByClassName('img-viewer').src);
}