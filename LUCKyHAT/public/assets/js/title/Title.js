

export class Title {

    constructor(ID, color, blur) {
        this.title = document.getElementById(ID);
        if (!this.title) {
            throw new Error(`Element with  ID - ${ID} - not find.`);
        }
        this.title.style.color = color;
        this.title.style.textShadow = `0 0 ${blur} ${color}`;
    }

    show() {
        this.title.style.opacity = '1';
    }

    hide() {
        this.title.style.opacity = '0';
    }
}
