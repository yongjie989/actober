"use strict";
var self = {};
var array = /\[([^\[]*)\]$/;
var get = self["get"] = function(q, opt)
{
	q = q || "";
	if ( typeof opt          == "undefined" ) opt = {};
	if ( typeof opt["full"]  == "undefined" ) opt["full"] = false;
	if ( typeof opt["array"] == "undefined" ) opt["array"] = false;

	if ( opt["full"] === true )
	{
		q = parse(q, {"get":false})["query"] || "";
	}

	var o = {};

	var c = q.split("&");
	for ( var i in c )
	{
		if (!c[i].length) continue;

		var d = c[i].indexOf("=");
		var k = c[i], v = true;
		if ( d >= 0 )
		{
			k = c[i].substr(0, d);
			v = c[i].substr(d+1);

			v = decodeURIComponent(v);
		}

		if (opt["array"])
		{
			var inds = [];
			var ind;
			var curo = o;
			var curk = k;
			while (ind = curk.match(array)) // Array!
			{
				curk = curk.substr(0, ind.index);
				inds.unshift(decodeURIComponent(ind[1]));
			}
			curk = decodeURIComponent(curk);
			if (inds.some(function(i)
			{
				if ( typeof curo[curk] == "undefined" ) curo[curk] = [];
				if (!Array.isArray(curo[curk]))
				{
					//console.log("url.get: Array property "+curk+" already exists as string!");
					return true;
				}

				curo = curo[curk];

				if ( i === "" ) i = curo.length;

				curk = i;
			})) continue;
			curo[curk] = v;
			continue;
		}

		k = decodeURIComponent(k);

		//typeof o[k] == "undefined" || console.log("Property "+k+" already exists!");
		o[k] = v;
	}

	return o;
};

var allchars = /./g;
var keyencode = {'?':"%3F", '&':"%26", '[':"%5B", ']':"%5D", '=': "%3D"};
var valencode = {'?':"%3F", '&':"%26"};
function translatekey(d){return keyencode[d[0]] || d[0]}
function translateval(d){return valencode[d[0]] || d[0]}
function encodeKey(k)
{
	return encodeURI(k).replace(allchars, translatekey);
}

function encodeValue(k)
{
	return encodeURI(k).replace(allchars, translateval);
}

var buildget = self["buildget"] = function(data, prefix)
{
	var itms = [];
	for ( var k in data )
	{
		var ek = encodeKey(k);
		if ( typeof prefix != "undefined" )
			ek = prefix+"["+ek+"]";

		var v = data[k];

		switch (typeof v)
		{
			case 'boolean':
				itms.push(ek);
				break;
			case 'number':
				v = v.toString();
			case 'string':
				itms.push(ek+"="+encodeValue(v));
				break;
			case 'object':
				itms.push(self["buildget"](v, ek));
				break;
		}
	}
	return itms.join("&");
}

var scheme = [
	/^([a-z]*:)?(\/\/)?/,
	/([a-z]*):/,
];
var user  = /^([^:@]*)(:[^@]*)?@/;
var pass  = /^:([^@]*)@/;
var host  = /^[0-9A-Za-z-._]+/;
var port  = /^:([0-9]*)/;
var path  = /^\/[^?#]*/;
var query = /^\?([^#]*)/;
var hash  = /^#(.*)$/;

var parse = self["parse"] = function(url, opt)
{
	var r = {}
	if ( typeof opt == "undefined" ) opt = {};

	r["url"] = url;

	do {
		var s0 = url.toLowerCase().match(scheme[0])
		if ( s0 === null ) break;
		if ( typeof s0[1] !== "undefined" )
		{
			var s1 = s0[1].match(scheme[1])
			r["scheme"] = s1[1];
		}
		url = url.slice(s0[0].length);
	} while (false);

	do {
		var u = url.match(user)
		if ( u === null ) break;
		r["user"] = decodeURIComponent(u[1]);

		url = url.slice(u[1].length);

		do {
			var p = url.match(pass)
			if ( p === null ) break;
			r["pass"] = decodeURIComponent(p[1]);

			url = url.slice(p[1].length+1); // +1 is for the ':'
		} while (false);

		url = url.slice(1); // Drop the '@'.
	} while (false);

	do {
		var h = url.match(host)
		if ( h === null ) break;
		r["host"] = h[0];

		url = url.slice(h[0].length);
	} while (false);

	do {
		var p = url.match(port)
		if ( p === null || p[1]==="" ) break;
		r["port"] = parseInt(p[1]);

		url = url.slice(p[0].length);
	} while (false);

	do {
		var p = url.match(path)
		if ( p === null ) break;
		r["path"] = decodeURIComponent(p[0]);

		url = url.slice(p[0].length);
	} while (false);

	do {
		var q = url.match(query)
		if ( q === null ) break;
		r["query"] = q[1];
		if ( opt["get"] !== false )
			r["get"] = get(r["query"], opt["get"]);

		url = url.slice(q[0].length);
	} while (false);

	do {
		var h = url.match(hash)
		if ( h === null ) break;
		r["hash"] = decodeURIComponent(h[1]);

		//url = url.slice(h[0].length);
	} while (false);

	return r;
}

var noslash = ["mailto","bitcoin"];

var build = self["build"] = function(data)
{
	var r = "";

	if ( typeof data["scheme"] != "undefined" )
	{
		r += data["scheme"];
		r += (noslash.indexOf(data["scheme"])>=0)?":":"://";
	}
	if ( typeof data["user"] != "undefined" )
	{
		r += data["user"];
		if ( typeof data["pass"] == "undefined" )
		{
			r += "@";
		}
	}
	if ( typeof data["pass"] != "undefined" )
	{
		r += ":" + data["pass"] + "@";
	}
	if ( typeof data["host"] != "undefined" )
	{
		r += data["host"];
	}
	if ( typeof data["port"] != "undefined" )
	{
		r += ":" + data["port"];
	}
	if ( typeof data["path"] != "undefined" )
	{
		r += data["path"];
	}

	if ( typeof data["get"] != "undefined" )
	{
		r += "?" + buildget(data["get"]);
	}
	else if ( typeof data["query"] != "undefined" )
	{
		r += "?" + data["query"];
	}

	if ( typeof data["hash"] != "undefined" )
	{
		r += "#" + data["hash"];
	}

	return r || data["url"] || "";
};

if ( typeof define != "undefined" && define["amd"] ) define(self);
else if ( typeof module != "undefined" ) module['exports'] = self;
else window["url"] = self;
