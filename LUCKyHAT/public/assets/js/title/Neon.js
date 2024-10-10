

export class Neon {

    constructor(pulses, interval, objects) {
        this.pulses = pulses;
        this.interval = interval;
        this.objects = objects;
    }

    load() {
        let pulse = 0;
        const animate = () => {
            this.objects.forEach(function(item) {
                item.show();
            });
            if (pulse < this.pulses) {
                if (pulse % 2 === 0) {
                    this.objects.forEach(function(item) {
                        item.hide();
                    });
                }
                pulse++;
                setTimeout(() => {
                    requestAnimationFrame(animate);
                }, this.interval);
            }
        };
        animate();
    }
}