const translations = require('./translations')
export default {
  translate (key, replacements = {}) {
    const lang = document.documentElement.lang
    let word = translations[lang]
    const fallback_locale = document.querySelector('meta[name="fallback_locale"]') || null

    const getAltValue = (object, keys) => keys.split('.').reduce((o, k) => (o || {})[k], object)

    const keys = key.split('.')
    for (const i in keys) {
      try {
        word = word[keys[i]]
        if (word === undefined) {
          if (fallback_locale.content) {
            word = getAltValue(translations[fallback_locale.content], key) || key
          } else {
            word = key
          }
          break
        }
      } catch (e) {
        word = key
        break
      }
    }
    for (const i in replacements) {
      word = word.replace(`:${i}`, replacements[i])
    }
    return word
  }
}
