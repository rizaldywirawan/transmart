module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        {
            pattern : /./,
        },
    ],
    theme: {
        extend: {
            fontFamily: {
                'body': ['Inter'],
            },
        },
    },
    plugins: [],
}
