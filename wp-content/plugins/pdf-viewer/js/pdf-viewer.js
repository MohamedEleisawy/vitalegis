class PDFViewer {
    constructor(container) {
        this.container = container;
        this.canvas = container.querySelector('#pdf-canvas');
        this.ctx = this.canvas.getContext('2d');
        this.currentPage = 1;
        this.zoom = 1;
        this.pdfDoc = null;

        this.initButtons();
        this.loadPDF();
    }

    initButtons() {
        this.container.querySelector('.pdf-prev').onclick = () => this.prevPage();
        this.container.querySelector('.pdf-next').onclick = () => this.nextPage();
        this.container.querySelector('.pdf-zoom-in').onclick = () => this.zoomIn();
        this.container.querySelector('.pdf-zoom-out').onclick = () => this.zoomOut();
        this.container.querySelector('.pdf-fullscreen').onclick = () => this.toggleFullscreen();
    }

    async loadPDF() {
        const url = this.container.getAttribute('data-pdf-url');
        const loadingTask = pdfjsLib.getDocument(url);
        
        try {
            this.pdfDoc = await loadingTask.promise;
            this.container.querySelector('.pdf-page-count').textContent = this.pdfDoc.numPages;
            this.renderPage(this.currentPage);
        } catch (error) {
            console.error('Erreur lors du chargement du PDF:', error);
        }
    }

    async renderPage(num) {
        const page = await this.pdfDoc.getPage(num);
        const viewport = page.getViewport({ scale: this.zoom });

        this.canvas.height = viewport.height;
        this.canvas.width = viewport.width;

        const renderContext = {
            canvasContext: this.ctx,
            viewport: viewport
        };

        await page.render(renderContext);
        this.container.querySelector('.pdf-page-num').textContent = num;
    }

    async prevPage() {
        if (this.currentPage <= 1) return;
        this.currentPage--;
        await this.renderPage(this.currentPage);
    }

    async nextPage() {
        if (this.currentPage >= this.pdfDoc.numPages) return;
        this.currentPage++;
        await this.renderPage(this.currentPage);
    }

    async zoomIn() {
        this.zoom *= 1.2;
        await this.renderPage(this.currentPage);
    }

    async zoomOut() {
        this.zoom *= 0.8;
        await this.renderPage(this.currentPage);
    }

    toggleFullscreen() {
        if (!document.fullscreenElement) {
            this.container.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const containers = document.querySelectorAll('.pdf-viewer-container');
    containers.forEach(container => new PDFViewer(container));
});
