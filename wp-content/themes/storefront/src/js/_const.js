export const {
  DOC,
  WIN,
  HTMLBODY,
  HTML,
  BODY,

  ACTIVE,
  OPEN,
  SHOW,
  FOCUS,
  ANIMATE,
  HIDDEN,
  NOSCROLL,
  ERROR,
  HASTEXT,
  STIKY
} = {
  DOC: $(document),
  WIN: $(window),
  HTMLBODY: $('html, body'),
  HTML: $('html'),
  BODY: $('body'),

  ACTIVE: 'is-active',
  OPEN: 'is-open',
  SHOW: 'is-show',
  FOCUS: 'is-focus',
  ANIMATE: 'is-animate',
  HIDDEN: 'is-hidden',
  NOSCROLL: 'no-scroll',
  ERROR: 'has-error',
  HASTEXT: 'has-text',
  STIKY: 'is-stiky'
};
