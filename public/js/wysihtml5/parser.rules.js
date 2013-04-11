
var parserRules = {
	classes: {
        "*": 1
    },
    tags: {
        "b":  {},
        "i":  {},
        "br": {},
        "ol": {},
        "ul": {},
        "li": {},
        "h1": {},
        "h2": {},
        "h3": {},
        "h4": {},
        "h5": {},
        "h6": {},
        "blockquote": {},
        "u": 1,
        "img": {
            "check_attributes": {
                "width": "numbers",
                "alt": "alt",
                "src": "url",
                "height": "numbers"
            }
        },
        "a":  {
            set_attributes: {
                target: "_blank",
                rel:    "nofollow"
            },
            check_attributes: {
                href:   "url" // important to avoid XSS
            }
        },
        "span": 1,
        "div": {
        	allow_attributes: [ "id" ]
        }
   }
};
