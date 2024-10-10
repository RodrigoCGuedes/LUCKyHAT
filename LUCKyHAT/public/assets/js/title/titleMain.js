
import { Icon } from './Icon.js';
import { Title } from './Title.js';
import { Loading } from './Loading.js';
import { Neon } from './Neon.js';

const width = 4;
const color = "#00ff00";
const blur = 10;
const canvas = "icon";

const icon = new Icon(canvas, width, color, blur);
const title = new Title('title', color, blur);
const loading = new Loading(canvas, width, color, blur);
const neon = new Neon(4, 100, [
    icon,
    title,
]);

window.addEventListener('load', () => {
    title.show();
    icon.show();
    neon.load();
});

window.addEventListener('unload', () => {
    title.show();
    icon.show();
    neon.load();
});

document.addEventListener('submit', (event) => {
    if (event.target.tagName === 'FORM') {
        event.preventDefault();
    
        loading.show(80);

        setTimeout(() => {
            event.target.submit();
        }, 100);
    }
});