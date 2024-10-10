
import { Drawable } from "./Drawable.js";

export class Loading extends Drawable {

    constructor(canvas, width, color, blur) {
        super(canvas, width, color, blur);
    }

    show(frameRate) {
        let start = Math.PI / 2;
        let end = 0;

        const animate = () => {
            if (!this.ctx) {
                console.error("In show() - Loading - ctx not exist.");
                return;
            }

            this.hide();

            this.draw.drawCurve(50, 50, 25, start, end);

            start += Math.PI / 2;
            end += Math.PI / 2;

            setTimeout(() => {
                requestAnimationFrame(animate);
            }, frameRate);
        }

        animate();
    }
}