
export class DrawNeon {

    constructor(ctx ,width, color, blur) {
        this.ctx = ctx;
        this.width = width;
        this.color = color;
        this.blur = blur;
    }
    
    drawLine(x, y, length, angle) {
        if (!this.ctx) {
            console.error("In drawLine() - DrawNeon - ctx not exist.");
            return;
        }

        const radians = (Math.PI / 180) * angle;
        const x2 = x + length * Math.cos(radians);
        const y2 = y + length * Math.sin(radians);

        this.ctx.beginPath();
        this.ctx.moveTo(x, y);
        this.ctx.lineTo(x2, y2);
        this.ctx.lineWidth = this.width;
        this.ctx.strokeStyle = this.color;
        this.ctx.shadowColor = this.color;
        this.ctx.shadowBlur = this.blur;
        this.ctx.stroke();
    }

    drawCurve(x, y, radius, startAngle, endAngle) {
        if (!this.ctx) {
            console.error("In drawCurve() - DrawNeon - ctx not exist.");
            return;
        }

        this.ctx.beginPath();
        this.ctx.arc(x, y, radius, startAngle, endAngle, true);
        this.ctx.lineWidth = this.width;
        this.ctx.strokeStyle = this.color;
        this.ctx.shadowColor = this.color;
        this.ctx.shadowBlur = this.blur;
        this.ctx.stroke();
    }
}