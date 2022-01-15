export default {
    success(message) {
        console.log("SUCCESS");
        window.dispatchEvent(new CustomEvent("toast", {detail: {
            status: "success",
            message: message
        }}));
    },

    error(message) {
        window.dispatchEvent(new CustomEvent("toast", {detail: {
            status: "error",
            message: message
        }}));
    },

    warning(message) {
        window.dispatchEvent(new CustomEvent("toast", {detail: {
            status: "warning",
            message: message
        }}));
    }
}
