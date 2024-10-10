
export class Footer {

    constructor() {
        this.footer = document.getElementById("footer");
        this.footerContent = document.getElementById("footer-content");
        this.smile = document.getElementById("smile");
        this.isVisible = true;

        this.smile.addEventListener('click', () => this.toggle());
    }

    show() {
        this.footerContent.style.display = "block";
        this.smile.textContent = "○";
        this.isVisible = true;
    }

    hide() {
        this.footerContent.style.display = "none";
        this.smile.textContent = "●";
        this.isVisible = false;
    }

    toggle() {
        if (this.isVisible) {
            this.hide();
        } else {
            this.show();
        }
    }
}