module.exports = {
    root: true,
    env: {
      browser: true,
      node: true
    },
    parserOptions: {
      parser: 'babel-eslint'
    },
    extends: [
      'plugin:vue/recommended',
      'plugin:prettier/recommended',
      'prettier',
      'prettier/vue'
    ],
    plugins: [
      'prettier'
    ],
    rules: {
      'no-console': 'off',
      'prettier/prettier': ['error', {
        singleQuote: true,
        trailingComma: 'es5',
        semi: false,
      }],
    }
  }