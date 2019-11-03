import 'focus-within-polyfill'

function ready() {
    // Code here
}

if (document.readyState !== 'loading') {
    ready()
} else {
    document.addEventListener('DOMContentLoaded', ready)
}
