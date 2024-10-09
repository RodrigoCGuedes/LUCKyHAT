
import { Drawable } from "./Drawable.js";

export class Icon extends Drawable {

    constructor(canvas, width, color, blur) {
        super(canvas, width, color, blur);
    }

    show() {
        if (!this.ctx) {
            console.error("In show() - Icon - ctx not exist.");
            return;
        }

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        this.draw.drawLine(58, 20, 20, 20);
        this.draw.drawLine(43, 20, 20, 160);
        this.draw.drawLine(35, 30, 20, 110);
        this.draw.drawLine(65, 30, 20, 70);
        this.draw.drawLine(69, 42, 20, 10);
        this.draw.drawLine(31, 42, 20, 170);

        this.draw.drawCurve(50, 36, 40, 2.95, 0.2);
    }
}