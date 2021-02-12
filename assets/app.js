/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

// console.log('Hello Webpack Encore! Edit me in assets/app.js');


document.getElementById('mode-button').addEventListener('click', show => {
  if (!document.getElementById('darkCss')) {
    let head  = document.getElementsByTagName('head')[0];
    let link  = document.createElement('link');
    link.id = 'darkCss'
    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = '../../build/app_dark.css'
    link.media = 'all';
    head.appendChild(link);

    document.cookie = "mode=dark";
  } else {

    let remove = document.getElementById('darkCss');
    remove.parentNode.removeChild(remove);
    document.cookie = "mode=light";
  }
})
