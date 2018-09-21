/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');
import axios from 'axios';


console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

function deleteButtonClicked(event){
    console.log(event);
    const itemId = event.target.getAttribute('data-id');
    console.log(itemId);
    //send then http req
    axios.delete('/todolist/deleteItem/' + itemId)
    .then(response =>location.reload()/*console.log(response)*/);
}
// This was my answer for it
// function completeButtonClicked(event){
//     console.log(event);
//     const itemId = event.target.getAttribute('data-id');
//     console.log(itemId);
//     // send then http req
//     axios.post('/todolist/completeItem/' + itemId)
//         .then(response =>location.reload()/*console.log(response)*/);
// }


let completeButtons = document.querySelectorAll('.completeButton');

completes.forEach(button => button.addEventListener('click', completeButtonClicked));


//THis is teacher's solution

function completeButtonClicked(event){
    console.log(event);
    const itemId = event.target.getAttribute('data-id');
    console.log(itemId);
    // send then http req
    axios.post('/todolist/item/' + itemId + '/toggleIsDone')
        .then(response =>location.reload()/*console.log(response)*/);
}

let deleteButtons = document.querySelectorAll('.deleteButton');

deleteButtons.forEach(button => button.addEventListener('click', deleteButtonClicked));


let isDoneButtons = document.querySelectorAll('.completeButton');

isDoneButtons.forEach(button => button.addEventListener('click', completeButtonClicked));