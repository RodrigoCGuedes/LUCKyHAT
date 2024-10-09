
import { DrawNeon } from "./DrawNeon.js";

export class Drawable {

    constructor(canvas, width, color, blur) {
        this.canvas = document.getElementById(canvas);
        this.ctx = this.canvas ? this.canvas.getContext('2d') : null;
        this.draw = new DrawNeon(this.ctx ,width, color, blur);
    }

    show() {
        throw new Error("Abstract method 'show' must be implemented by subclass.");
    }

    hide() {
        if (!this.ctx) return;
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }

}