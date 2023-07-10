class Toast {
    constructor() {
        this.elem = document.getElementById("toast");
        this.instance = new bootstrap.Toast(this.elem);

        this.body = this.elem.querySelector(".toast-body");

        this.role = "";

        this.elem.addEventListener("hidden.bs.toast", () => {
            this.reset();
        });
    }

    show(message, role) {
        this.reset();
        this.body.textContent = message;
        this.setRole(role);

        this.instance.show();
    }

    reset() {
        this.body.textContent = "";
        this.resetRole();
    }

    setRole(role) {
        this.role = role;
        this.elem.classList.add(`text-bg-${this.role}`);
    }

    resetRole() {
        this.elem.classList.remove(`text-bg-${this.role}`);
    }
}

const toast = new Toast();

export default toast;
