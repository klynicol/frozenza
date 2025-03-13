import { jsx, jsxs, Fragment } from "react/jsx-runtime";
import React, { forwardRef, useRef, useImperativeHandle, useEffect, useState, createContext, useContext } from "react";
import { Link, useForm, Head, router, usePage, createInertiaApp } from "@inertiajs/react";
import { Transition, Dialog, TransitionChild, DialogPanel } from "@headlessui/react";
import { XMarkIcon } from "@heroicons/react/24/outline";
import axios from "axios";
import createServer from "@inertiajs/react/server";
import ReactDOMServer from "react-dom/server";
function InputError({ message, className = "", ...props }) {
  return message ? /* @__PURE__ */ jsx(
    "p",
    {
      ...props,
      className: "text-sm text-red-600 " + className,
      children: message
    }
  ) : null;
}
function InputLabel({
  value,
  className = "",
  children,
  ...props
}) {
  return /* @__PURE__ */ jsx(
    "label",
    {
      ...props,
      className: `block text-sm font-medium text-gray-700 ` + className,
      children: value ? value : children
    }
  );
}
function PrimaryButton({
  className = "",
  disabled,
  children,
  ...props
}) {
  return /* @__PURE__ */ jsx(
    "button",
    {
      ...props,
      className: `inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 ${disabled && "opacity-25"} ` + className,
      disabled,
      children
    }
  );
}
const TextInput = forwardRef(function TextInput2({ type = "text", className = "", isFocused = false, ...props }, ref) {
  const localRef = useRef(null);
  useImperativeHandle(ref, () => ({
    focus: () => {
      var _a;
      return (_a = localRef.current) == null ? void 0 : _a.focus();
    }
  }));
  useEffect(() => {
    var _a;
    if (isFocused) {
      (_a = localRef.current) == null ? void 0 : _a.focus();
    }
  }, [isFocused]);
  return /* @__PURE__ */ jsx(
    "input",
    {
      ...props,
      type,
      className: "rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 " + className,
      ref: localRef
    }
  );
});
function ApplicationLogo(props) {
  return /* @__PURE__ */ jsx(
    "img",
    {
      src: "/storage/assets/pizza_kraken_favicon.png",
      alt: "Pizza Kraken Logo",
      className: "w-10 h-10",
      width: 100,
      height: 100,
      ...props,
      loading: "lazy"
    }
  );
}
function GuestLayout({ children }) {
  return /* @__PURE__ */ jsxs("div", { className: "flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0", children: [
    /* @__PURE__ */ jsx("div", { children: /* @__PURE__ */ jsx(Link, { href: "/", children: /* @__PURE__ */ jsx(ApplicationLogo, { className: "h-20 w-20 fill-current text-gray-500" }) }) }),
    /* @__PURE__ */ jsx("div", { className: "mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg", children })
  ] });
}
function ConfirmPassword() {
  const { data, setData, post, processing, errors, reset } = useForm({
    password: ""
  });
  const submit = (e) => {
    e.preventDefault();
    post(route("password.confirm"), {
      onFinish: () => reset("password")
    });
  };
  return /* @__PURE__ */ jsxs(GuestLayout, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Confirm Password" }),
    /* @__PURE__ */ jsx("div", { className: "mb-4 text-sm text-gray-600", children: "This is a secure area of the application. Please confirm your password before continuing." }),
    /* @__PURE__ */ jsxs("form", { onSubmit: submit, children: [
      /* @__PURE__ */ jsxs("div", { className: "mt-4", children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "password", value: "Password" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "password",
            type: "password",
            name: "password",
            value: data.password,
            className: "mt-1 block w-full",
            isFocused: true,
            onChange: (e) => setData("password", e.target.value)
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.password, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsx("div", { className: "mt-4 flex items-center justify-end", children: /* @__PURE__ */ jsx(PrimaryButton, { className: "ms-4", disabled: processing, children: "Confirm" }) })
    ] })
  ] });
}
const __vite_glob_0_0 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: ConfirmPassword
}, Symbol.toStringTag, { value: "Module" }));
function PlusIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 24, height: 24, viewBox: "0 0 24 24", ...props, children: /* @__PURE__ */ jsx("path", { fill: "currentColor", fillRule: "evenodd", d: "M13 13v7a1 1 0 0 1-2 0v-7H4a1 1 0 0 1 0-2h7V4a1 1 0 0 1 2 0v7h7a1 1 0 0 1 0 2z" }) });
}
function MinusIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 24, height: 24, viewBox: "0 0 24 24", ...props, children: /* @__PURE__ */ jsx("path", { fill: "currentColor", fillRule: "evenodd", d: "M4 11h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2" }) });
}
function FacebookIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 24, height: 24, viewBox: "0 0 24 24", ...props, children: /* @__PURE__ */ jsx("path", { fill: "currentColor", fillRule: "evenodd", d: "M15.725 22v-7.745h2.6l.389-3.018h-2.99V9.31c0-.874.243-1.47 1.497-1.47h1.598v-2.7a21 21 0 0 0-2.33-.12c-2.304 0-3.881 1.407-3.881 3.99v2.227H10v3.018h2.607V22H3.104C2.494 22 2 21.506 2 20.896V3.104C2 2.494 2.494 2 3.104 2h17.792C21.506 2 22 2.494 22 3.104v17.792c0 .61-.494 1.104-1.104 1.104z" }) });
}
function DiscordIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 24, height: 24, viewBox: "0 0 24 24", ...props, children: /* @__PURE__ */ jsx("path", { fill: "currentColor", d: "M20.317 4.492c-1.53-.69-3.17-1.2-4.885-1.49a.075.075 0 0 0-.079.036c-.21.369-.444.85-.608 1.23a18.6 18.6 0 0 0-5.487 0a12 12 0 0 0-.617-1.23A.08.08 0 0 0 8.562 3c-1.714.29-3.354.8-4.885 1.491a.1.1 0 0 0-.032.027C.533 9.093-.32 13.555.099 17.961a.08.08 0 0 0 .031.055a20 20 0 0 0 5.993 2.98a.08.08 0 0 0 .084-.026a14 14 0 0 0 1.226-1.963a.074.074 0 0 0-.041-.104a13 13 0 0 1-1.872-.878a.075.075 0 0 1-.008-.125q.19-.14.372-.287a.08.08 0 0 1 .078-.01c3.927 1.764 8.18 1.764 12.061 0a.08.08 0 0 1 .079.009q.18.148.372.288a.075.075 0 0 1-.006.125q-.895.515-1.873.877a.075.075 0 0 0-.041.105c.36.687.772 1.341 1.225 1.962a.08.08 0 0 0 .084.028a20 20 0 0 0 6.002-2.981a.08.08 0 0 0 .032-.054c.5-5.094-.838-9.52-3.549-13.442a.06.06 0 0 0-.031-.028M8.02 15.278c-1.182 0-2.157-1.069-2.157-2.38c0-1.312.956-2.38 2.157-2.38c1.21 0 2.176 1.077 2.157 2.38c0 1.312-.956 2.38-2.157 2.38m7.975 0c-1.183 0-2.157-1.069-2.157-2.38c0-1.312.955-2.38 2.157-2.38c1.21 0 2.176 1.077 2.157 2.38c0 1.312-.946 2.38-2.157 2.38" }) });
}
function GoogleIcon(props) {
  return /* @__PURE__ */ jsxs("svg", { xmlns: "http://www.w3.org/2000/svg", width: 128, height: 128, viewBox: "0 0 128 128", ...props, children: [
    /* @__PURE__ */ jsx("path", { fill: "#fff", d: "M44.59 4.21a63.28 63.28 0 0 0 4.33 120.9a67.6 67.6 0 0 0 32.36.35a57.13 57.13 0 0 0 25.9-13.46a57.44 57.44 0 0 0 16-26.26a74.3 74.3 0 0 0 1.61-33.58H65.27v24.69h34.47a29.72 29.72 0 0 1-12.66 19.52a36.2 36.2 0 0 1-13.93 5.5a41.3 41.3 0 0 1-15.1 0A37.2 37.2 0 0 1 44 95.74a39.3 39.3 0 0 1-14.5-19.42a38.3 38.3 0 0 1 0-24.63a39.25 39.25 0 0 1 9.18-14.91A37.17 37.17 0 0 1 76.13 27a34.3 34.3 0 0 1 13.64 8q5.83-5.8 11.64-11.63c2-2.09 4.18-4.08 6.15-6.22A61.2 61.2 0 0 0 87.2 4.59a64 64 0 0 0-42.61-.38" }),
    /* @__PURE__ */ jsx("path", { fill: "#e33629", d: "M44.59 4.21a64 64 0 0 1 42.61.37a61.2 61.2 0 0 1 20.35 12.62c-2 2.14-4.11 4.14-6.15 6.22Q95.58 29.23 89.77 35a34.3 34.3 0 0 0-13.64-8a37.17 37.17 0 0 0-37.46 9.74a39.25 39.25 0 0 0-9.18 14.91L8.76 35.6A63.53 63.53 0 0 1 44.59 4.21" }),
    /* @__PURE__ */ jsx("path", { fill: "#f8bd00", d: "M3.26 51.5a63 63 0 0 1 5.5-15.9l20.73 16.09a38.3 38.3 0 0 0 0 24.63q-10.36 8-20.73 16.08a63.33 63.33 0 0 1-5.5-40.9" }),
    /* @__PURE__ */ jsx("path", { fill: "#587dbd", d: "M65.27 52.15h59.52a74.3 74.3 0 0 1-1.61 33.58a57.44 57.44 0 0 1-16 26.26c-6.69-5.22-13.41-10.4-20.1-15.62a29.72 29.72 0 0 0 12.66-19.54H65.27c-.01-8.22 0-16.45 0-24.68" }),
    /* @__PURE__ */ jsx("path", { fill: "#319f43", d: "M8.75 92.4q10.37-8 20.73-16.08A39.3 39.3 0 0 0 44 95.74a37.2 37.2 0 0 0 14.08 6.08a41.3 41.3 0 0 0 15.1 0a36.2 36.2 0 0 0 13.93-5.5c6.69 5.22 13.41 10.4 20.1 15.62a57.13 57.13 0 0 1-25.9 13.47a67.6 67.6 0 0 1-32.36-.35a63 63 0 0 1-23-11.59A63.7 63.7 0 0 1 8.75 92.4" })
  ] });
}
function TwitterIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 14, height: 14, viewBox: "0 0 14 14", ...props, children: /* @__PURE__ */ jsxs("g", { fill: "none", children: [
    /* @__PURE__ */ jsx("g", { clipPath: "url(#primeTwitter0)", children: /* @__PURE__ */ jsx("path", { fill: "currentColor", d: "M11.025.656h2.147L8.482 6.03L14 13.344H9.68L6.294 8.909l-3.87 4.435H.275l5.016-5.75L0 .657h4.43L7.486 4.71zm-.755 11.4h1.19L3.78 1.877H2.504z" }) }),
    /* @__PURE__ */ jsx("defs", { children: /* @__PURE__ */ jsx("clipPath", { id: "primeTwitter0", children: /* @__PURE__ */ jsx("path", { fill: "#fff", d: "M0 0h14v14H0z" }) }) })
  ] }) });
}
function InstagramIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 24, height: 24, viewBox: "-2 -2 24 24", ...props, children: /* @__PURE__ */ jsxs("g", { fill: "currentColor", children: [
    /* @__PURE__ */ jsx("path", { d: "M14.017 0h-8.07A5.954 5.954 0 0 0 0 5.948v8.07a5.954 5.954 0 0 0 5.948 5.947h8.07a5.954 5.954 0 0 0 5.947-5.948v-8.07A5.954 5.954 0 0 0 14.017 0m3.94 14.017a3.94 3.94 0 0 1-3.94 3.94h-8.07a3.94 3.94 0 0 1-3.939-3.94v-8.07a3.94 3.94 0 0 1 3.94-3.939h8.07a3.94 3.94 0 0 1 3.939 3.94v8.07z" }),
    /* @__PURE__ */ jsx("path", { d: "M9.982 4.819A5.17 5.17 0 0 0 4.82 9.982a5.17 5.17 0 0 0 5.163 5.164a5.17 5.17 0 0 0 5.164-5.164A5.17 5.17 0 0 0 9.982 4.82zm0 8.319a3.155 3.155 0 1 1 0-6.31a3.155 3.155 0 0 1 0 6.31" }),
    /* @__PURE__ */ jsx("circle", { cx: 15.156, cy: 4.858, r: 1.237 })
  ] }) });
}
function PizzaIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 512, height: 512, viewBox: "0 0 512 512", ...props, children: /* @__PURE__ */ jsx("path", { fill: "currentColor", d: "M255.5 16a239.9 239.9 0 0 0-128.6 37.69l9.1 13.17C171.9 44.09 213.5 32 256 32c27.3 0 54.4 4.98 79.9 14.72l6.3-14.71A240 240 0 0 0 256 16zm103.3 23.12l-6.3 14.71c54.3 25.91 95.9 72.57 115.4 129.47l15.3-4.6c-14.4-65.2-56-117.4-124.4-139.58M255.4 51c-38.4.11-76.1 11.02-108.6 31.49L254.1 237.5c31.2-55.8 54.7-114 74.3-173.3C305.3 55.47 280.7 51 256 51zm29.4 8.93l19.1 23.86l-14 11.25l-19.1-23.87zm-172.7 4C37.18 104.2 20.64 165.2 17.2 232l15.98 1c6.39-61.9 38.28-118.4 88.02-155.91zM222.2 71c8.2 0 15.8 2.12 21.9 6.2c6.1 4.07 11 10.75 11 18.8c0 8.1-4.9 14.7-11 18.8s-13.7 6.2-21.9 6.2s-15.8-2.1-21.9-6.2s-11-10.7-11-18.8c0-8.05 4.9-14.73 11-18.8c6.1-4.08 13.7-6.2 21.9-6.2m122.8.31c-18.3 59.29-41.7 116.49-73.1 170.49l68.3-20.4c-3.2-4.9-5-10.9-5-17.2c0-15 10.5-28.8 25.4-28.8s25.4 13.8 25.4 28.8c0 1.2-.1 2.4-.2 3.7l63.9-19.1C431.8 137.3 394.1 94.98 345 71.31M222.2 89c-5 0-9.3 1.44-11.9 3.16c-2.6 1.71-3 3.05-3 3.84s.4 2.13 3 3.84c2.6 1.76 6.9 3.16 11.9 3.16s9.3-1.4 11.9-3.16c2.6-1.71 3-3.05 3-3.84s-.4-2.13-3-3.84c-2.6-1.72-6.9-3.16-11.9-3.16M132 92.72C87.04 126.9 58.15 178.1 52.16 234.2c62.64.6 125.14 1.8 185.94 11.6L219 218.2l-18.5 10.1l-8.6-15.8l16.8-9.2l-57-82.1l-23.1 18.3l-11.2-14.2l24-19zm233.6 13.78l12.2 20.1l-15.4 9.4l-12.2-20.1zm-106.5 23.1l7.8 16.2l-30.2 14.3l-7.8-16.2zM123.4 151c17 0 29.6 15.6 29.6 33s-12.6 33-29.6 33s-29.6-15.6-29.6-33s12.6-33 29.6-33m298 9.3l3.7 27.6l-17.8 2.4l-3.7-27.6zm-298 8.7c-5.7 0-11.6 5.9-11.6 15s5.9 15 11.6 15s11.6-5.9 11.6-15s-5.9-15-11.6-15m237.2 24.4c-3.2 0-7.4 3.9-7.4 10.8s4.2 10.8 7.4 10.8s7.4-3.9 7.4-10.8s-4.2-10.8-7.4-10.8m127.8 2.6l-15.4 4.5c4.6 18.1 7 36.8 7 55.5c0 47.1-14.8 93-42.4 131.2l12.6 9.9C480 356.1 496 306.7 496 256c0-20.2-2.5-40.4-7.6-60m-33.6 10l-124 37.1l10 7.1l-10.4 14.6l-21.4-15.2l-33.8 10.1c45.1 42.9 97.7 77.7 147.4 115.7C446.4 340.6 454 298.8 461 256c2.7-16.7-2.1-33.7-6.2-50M16.07 250c-.1 2 0 4-.1 6c-5.08 70.3 9.06 138.7 82.57 181.2l10.06-12.5C59.92 382.2 31.99 320.7 32 256v-5zm34.97 2.2v3.8c0 22 3.52 43.8 10.45 64.7l10.99-23.5l16.3 7.6l-18.13 38.8c11.94 25.3 28.91 47.8 49.85 66.3l117.5-146l-129.1-8.1l-24.6 24.5l-12.72-12.8l13.22-13.2zm367.56 13.1c2.3-.1 4.6.2 6.9 1c7.2 2.2 12.3 8.1 14.7 14.8c2.4 6.5 2.4 13.9.1 21.2c-2.2 7.2-6.6 13.3-12.2 17.4c-5.8 3.9-13.3 5.9-20.6 3.6c-2.6-.8-4.9-2.1-6.9-3.7l-7.8 8.9l-27.6-23.8l11.8-13.6l14.5 12.5c-1-5.3-.6-10.9 1.1-16.3c2.3-7.3 6.6-13.3 12.3-17.3c4-2.8 8.8-4.6 13.7-4.7m-261.1 5.5l29.7 11.2l-6.4 16.8l-29.7-11.2zm108.7 4.6l5.3 84.6c4.8 1 9.2 2.6 13.1 4.9c6.7 3.9 12.4 10.6 12.4 19.1s-5.7 15.2-12.4 19.1c-3.1 1.8-6.5 3.2-10.1 4.2l3.3 52.5c11.1-1.2 22-3.3 32.7-6.2l3.5-29.1l17.8 2.2l-2.5 20.7c31.8-12.1 60-32 82.2-57.8c-20.7-16.3-45.4-27.9-62.2-48.9l-7.2 20.1l-17-6l9.2-25.9c-28.2-14-45.8-35.4-68.1-53.5m-17.7 4.3l-114 141.4C169.7 447 212.3 461 256 461h3.8l-3.3-52.2c-7.2-.5-13.8-2.4-19.3-5.7c-6.7-3.9-12.4-10.6-12.4-19.1s5.7-15.2 12.4-19.1c4.7-2.8 10.3-4.6 16.3-5.4zm170.6 3.6c-1-.1-2.2.3-3.8 1.3c-2.1 1.5-4.3 4.4-5.5 8.1c-1.1 3.7-.9 7.3-.1 9.7c.9 2.4 2.1 3.4 3.2 3.7c1.2.4 2.7.2 4.8-1.2c2-1.4 4.3-4.3 5.5-8c1.1-3.7.9-7.4.1-9.7c-.9-2.4-2.1-3.4-3.2-3.8c-.3-.1-.6-.1-1-.1m-293.3 29.9c4.3.1 8.6 1.1 12.6 3c14.3 6.9 21.3 24.1 14.4 38.4c-6.9 14.4-24.7 19.7-39 12.8c-14.32-6.9-21.26-24-14.38-38.4c4.98-10.3 15.48-15.9 26.38-15.8m-.9 17.9c-4 .1-7.6 2.2-9.3 5.7c-2.4 5.1-.1 11.5 6 14.4s12.5.7 15-4.4c2.4-5 .1-11.4-6-14.3c-1.9-1-3.9-1.4-5.7-1.4m136 45.9c-6 0-11.4 1.6-14.6 3.4c-3.2 1.9-3.5 3.3-3.5 3.6s.3 1.7 3.5 3.6c3.2 1.8 8.6 3.4 14.6 3.4s11.4-1.6 14.6-3.4c3.2-1.9 3.5-3.3 3.5-3.6s-.3-1.7-3.5-3.6c-3.2-1.8-8.6-3.4-14.6-3.4m165.5 24.4c-37.4 43.8-90.1 71.5-147.4 77.4l1 16c64 3.3 124.6-11.3 159-83.5zm-245.9 3l28.1 2.6l-1.6 18l-28.1-2.6zm-57.9 31.5l-10 12.5c36.1 45 90.2 51.7 143.4 47.6c2-.2 4 0 6-.1l-1-16c-1.7.1-3.3.1-5 .1c-48 0-94.8-15.5-133.4-44.1" }) });
}
function StarOutlineIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 24, height: 24, viewBox: "0 0 24 24", ...props, children: /* @__PURE__ */ jsx("path", { fill: "none", stroke: "currentColor", strokeWidth: 2, d: "M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597z" }) });
}
function StarFilledIcon(props) {
  return /* @__PURE__ */ jsx("svg", { xmlns: "http://www.w3.org/2000/svg", width: 24, height: 24, viewBox: "0 0 24 24", ...props, children: /* @__PURE__ */ jsx("path", { fill: "currentColor", d: "M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937l-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39l3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36z" }) });
}
function ExternalLinkIcon(props) {
  return /* @__PURE__ */ jsx("svg", { className: "w-4 h-4", fill: "none", stroke: "currentColor", viewBox: "0 0 24 24", ...props, children: /* @__PURE__ */ jsx("path", { strokeLinecap: "round", strokeLinejoin: "round", strokeWidth: 2, d: "M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" }) });
}
function Navbar({ auth }) {
  const [isOpen, setIsOpen] = useState(false);
  const socialLinks = [
    { icon: FacebookIcon, href: "https://www.facebook.com/profile.php?id=61573217433128", label: "Facebook" },
    { icon: DiscordIcon, href: "https://discord.gg/ccGKZPE76k", label: "Discord" },
    { icon: InstagramIcon, href: "https://www.instagram.com/pizza.kraken", label: "Instagram" },
    { icon: TwitterIcon, href: "https://x.com/pizza_kraken", label: "Twitter" }
    // { icon: BlueSkyIcon, href: 'https://bsky.app/profile/pizza-kraken.bsky.social', label: 'BlueSky' },
  ];
  return /* @__PURE__ */ jsxs("nav", { className: "bg-white shadow", children: [
    /* @__PURE__ */ jsx("div", { className: "container mx-auto px-4", children: /* @__PURE__ */ jsxs("div", { className: "flex justify-between h-16", children: [
      /* @__PURE__ */ jsxs("div", { className: "flex", children: [
        /* @__PURE__ */ jsx("div", { className: "flex items-center", children: /* @__PURE__ */ jsx("span", { className: "text-xl font-bold text-gray-800", children: /* @__PURE__ */ jsx(Link, { href: "/", children: /* @__PURE__ */ jsx(ApplicationLogo, { className: "h-10 w-10 fill-current text-gray-500" }) }) }) }),
        /* @__PURE__ */ jsxs("div", { className: "hidden md:ml-10 md:flex md:items-center md:space-x-4", children: [
          /* @__PURE__ */ jsx(
            Link,
            {
              href: "/top-rated",
              className: "text-gray-600 hover:text-gray-900",
              children: "Top Rated"
            }
          ),
          /* @__PURE__ */ jsx(
            Link,
            {
              href: "/brands",
              className: "text-gray-600 hover:text-gray-900",
              children: "Brands"
            }
          ),
          /* @__PURE__ */ jsx(
            Link,
            {
              href: "/contact",
              className: "text-gray-600 hover:text-gray-900",
              children: "Contact"
            }
          ),
          /* @__PURE__ */ jsx(
            Link,
            {
              href: "/blogs",
              className: "text-gray-600 hover:text-gray-900",
              children: "Blog"
            }
          )
        ] })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "hidden md:flex md:items-center md:space-x-4", children: [
        /* @__PURE__ */ jsx("div", { className: "flex space-x-3 mr-4", children: socialLinks.map((social) => /* @__PURE__ */ jsx(
          "a",
          {
            href: social.href,
            target: "_blank",
            rel: "noopener noreferrer",
            className: "text-gray-600 hover:text-gray-900 transition-colors",
            "aria-label": social.label,
            children: /* @__PURE__ */ jsx(social.icon, { className: "w-8 h-8" })
          },
          social.label
        )) }),
        auth.user ? /* @__PURE__ */ jsx(
          "button",
          {
            type: "submit",
            className: "text-gray-600 hover:text-gray-900",
            onClick: () => {
              router.post("/logout");
            },
            children: "Logout"
          }
        ) : /* @__PURE__ */ jsx(
          Link,
          {
            href: "/login",
            className: "text-gray-600 hover:text-gray-900",
            children: "Login"
          }
        )
      ] }),
      /* @__PURE__ */ jsx("div", { className: "flex items-center md:hidden", children: /* @__PURE__ */ jsxs(
        "button",
        {
          onClick: () => setIsOpen(!isOpen),
          className: "inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500",
          "aria-expanded": "false",
          children: [
            /* @__PURE__ */ jsx("span", { className: "sr-only", children: "Open main menu" }),
            !isOpen ? /* @__PURE__ */ jsx("svg", { className: "block h-6 w-6", xmlns: "http://www.w3.org/2000/svg", fill: "none", viewBox: "0 0 24 24", stroke: "currentColor", children: /* @__PURE__ */ jsx("path", { strokeLinecap: "round", strokeLinejoin: "round", strokeWidth: 2, d: "M4 6h16M4 12h16M4 18h16" }) }) : /* @__PURE__ */ jsx("svg", { className: "block h-6 w-6", xmlns: "http://www.w3.org/2000/svg", fill: "none", viewBox: "0 0 24 24", stroke: "currentColor", children: /* @__PURE__ */ jsx("path", { strokeLinecap: "round", strokeLinejoin: "round", strokeWidth: 2, d: "M6 18L18 6M6 6l12 12" }) })
          ]
        }
      ) })
    ] }) }),
    /* @__PURE__ */ jsx("div", { className: `${isOpen ? "block" : "hidden"} md:hidden`, children: /* @__PURE__ */ jsxs("div", { className: "px-2 pt-2 pb-3 space-y-1", children: [
      /* @__PURE__ */ jsx(
        Link,
        {
          href: "/top-rated",
          className: "block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50",
          children: "Top Rated"
        }
      ),
      /* @__PURE__ */ jsx(
        Link,
        {
          href: "/brands",
          className: "block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50",
          children: "Brands"
        }
      ),
      /* @__PURE__ */ jsx(
        Link,
        {
          href: "/contact",
          className: "block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50",
          children: "Contact"
        }
      ),
      /* @__PURE__ */ jsx("div", { className: "flex space-x-4 px-3 py-2", children: socialLinks.map((social) => /* @__PURE__ */ jsx(
        "a",
        {
          href: social.href,
          target: "_blank",
          rel: "noopener noreferrer",
          className: "text-gray-700 hover:text-gray-900",
          "aria-label": social.label,
          children: /* @__PURE__ */ jsx(social.icon, { className: "w-5 h-5" })
        },
        social.label
      )) }),
      auth.user ? /* @__PURE__ */ jsx(
        "button",
        {
          type: "submit",
          className: "block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50",
          onClick: () => {
            router.post("/logout");
          },
          children: "Logout"
        }
      ) : /* @__PURE__ */ jsx(
        Link,
        {
          href: "/login",
          className: "block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50",
          children: "Login"
        }
      )
    ] }) })
  ] });
}
function Footer() {
  return /* @__PURE__ */ jsx("footer", { className: "bg-gray-800 text-white", children: /* @__PURE__ */ jsxs("div", { className: "container mx-auto px-4 py-8", children: [
    /* @__PURE__ */ jsx("div", { className: "grid grid-cols-1 md:grid-cols-4 gap-8", children: /* @__PURE__ */ jsxs("div", { children: [
      /* @__PURE__ */ jsx("h3", { className: "text-lg font-bold mb-4", children: "Quick Links" }),
      /* @__PURE__ */ jsxs("ul", { className: "space-y-2", children: [
        /* @__PURE__ */ jsx("li", { children: /* @__PURE__ */ jsx(Link, { href: "/top-rated", className: "hover:text-gray-300", children: "Top Rated Pizzas" }) }),
        /* @__PURE__ */ jsx("li", { children: /* @__PURE__ */ jsx(Link, { href: "/brands", className: "hover:text-gray-300", children: "Browse Brands" }) }),
        /* @__PURE__ */ jsx("li", { children: /* @__PURE__ */ jsx(Link, { href: "/contact", className: "hover:text-gray-300", children: "Contact Us" }) }),
        /* @__PURE__ */ jsx("li", { children: /* @__PURE__ */ jsx(Link, { href: "/privacy", className: "hover:text-gray-300", children: "Privacy Policy" }) })
      ] })
    ] }) }),
    /* @__PURE__ */ jsx("div", { className: "mt-8 pt-8 border-t border-gray-700 text-center", children: /* @__PURE__ */ jsxs("p", { children: [
      "© ",
      (/* @__PURE__ */ new Date()).getFullYear(),
      " PizzaKraken.com. All rights reserved."
    ] }) })
  ] }) });
}
function MetaTags({ title, description, canonicalUrl, keywords }) {
  const baseUrl = "http://127.0.0.1:8001";
  const fullCanonicalUrl = canonicalUrl ? `${baseUrl}${canonicalUrl}` : "";
  const isServer2 = typeof window === "undefined";
  if (isServer2) {
    return /* @__PURE__ */ jsxs(Head, { children: [
      /* @__PURE__ */ jsx("title", { children: title }),
      /* @__PURE__ */ jsx("meta", { name: "description", content: description }),
      /* @__PURE__ */ jsx("meta", { name: "keywords", content: keywords }),
      /* @__PURE__ */ jsx("link", { rel: "canonical", href: fullCanonicalUrl })
    ] });
  }
  return /* @__PURE__ */ jsxs(Head, { children: [
    /* @__PURE__ */ jsx("title", { children: title }),
    /* @__PURE__ */ jsx("meta", { name: "description", content: description }),
    /* @__PURE__ */ jsx("meta", { name: "keywords", content: keywords }),
    /* @__PURE__ */ jsx("meta", { property: "og:title", content: title }),
    /* @__PURE__ */ jsx("meta", { property: "og:description", content: description }),
    /* @__PURE__ */ jsx("meta", { property: "og:image", content: `${baseUrl}/storage/assets/social_image.png` }),
    /* @__PURE__ */ jsx("meta", { property: "og:type", content: "website" }),
    /* @__PURE__ */ jsx("meta", { name: "twitter:card", content: "summary_large_image" }),
    /* @__PURE__ */ jsx("meta", { name: "twitter:title", content: title }),
    /* @__PURE__ */ jsx("meta", { name: "twitter:description", content: description }),
    /* @__PURE__ */ jsx("meta", { name: "twitter:image", content: `${baseUrl}/storage/assets/social_image.png` }),
    /* @__PURE__ */ jsx("meta", { property: "og:url", content: fullCanonicalUrl }),
    /* @__PURE__ */ jsx("link", { rel: "canonical", href: fullCanonicalUrl })
  ] });
}
function MessageNotification({ message, sender, isVisible, onClose }) {
  return /* @__PURE__ */ jsx("div", { className: "fixed bottom-4 right-4 z-50", children: /* @__PURE__ */ jsx(
    Transition,
    {
      show: isVisible,
      enter: "transform ease-out duration-300 transition",
      enterFrom: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2",
      enterTo: "translate-y-0 opacity-100 sm:translate-x-0",
      leave: "transition ease-in duration-100",
      leaveFrom: "opacity-100",
      leaveTo: "opacity-0",
      children: /* @__PURE__ */ jsx("div", { className: "max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto", children: /* @__PURE__ */ jsx("div", { className: "p-4", children: /* @__PURE__ */ jsxs("div", { className: "flex items-start", children: [
        /* @__PURE__ */ jsxs("div", { className: "flex-1", children: [
          /* @__PURE__ */ jsxs("p", { className: "text-sm font-medium text-gray-900", children: [
            "New message from ",
            sender
          ] }),
          /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-gray-500", children: message.length > 50 ? message.substring(0, 50) + "..." : message })
        ] }),
        /* @__PURE__ */ jsx(
          "button",
          {
            onClick: onClose,
            className: "ml-4 text-gray-400 hover:text-gray-500 focus:outline-none",
            children: /* @__PURE__ */ jsx(XMarkIcon, { className: "h-5 w-5" })
          }
        )
      ] }) }) })
    }
  ) });
}
function MainLayout({ children, meta, auth }) {
  const [notification, setNotification] = useState({
    message: "",
    sender: "",
    isVisible: false
  });
  return /* @__PURE__ */ jsxs(Fragment, { children: [
    /* @__PURE__ */ jsx(MetaTags, { ...meta }),
    /* @__PURE__ */ jsxs("div", { className: "min-h-screen bg-gray-100", children: [
      /* @__PURE__ */ jsx(Navbar, { auth }),
      /* @__PURE__ */ jsx("main", { className: "container mx-auto px-4 py-8", children }),
      /* @__PURE__ */ jsx(Footer, {})
    ] }),
    /* @__PURE__ */ jsx(
      MessageNotification,
      {
        ...notification,
        onClose: () => setNotification((prev) => ({ ...prev, isVisible: false }))
      }
    )
  ] });
}
const DeleteDataInstructions = ({ meta, auth }) => {
  return /* @__PURE__ */ jsx(MainLayout, { meta, auth, children: /* @__PURE__ */ jsxs("div", { children: [
    /* @__PURE__ */ jsx("h1", { children: "Delete Data Instructions" }),
    /* @__PURE__ */ jsx("p", { children: "To delete your data, please go to your user profile and click on the 'Delete Data' button." })
  ] }) });
};
const __vite_glob_0_1 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: DeleteDataInstructions
}, Symbol.toStringTag, { value: "Module" }));
function ForgotPassword({ status }) {
  const { data, setData, post, processing, errors } = useForm({
    email: ""
  });
  const submit = (e) => {
    e.preventDefault();
    post(route("password.email"));
  };
  return /* @__PURE__ */ jsxs(GuestLayout, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Forgot Password" }),
    /* @__PURE__ */ jsx("div", { className: "mb-4 text-sm text-gray-600", children: "Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one." }),
    status && /* @__PURE__ */ jsx("div", { className: "mb-4 text-sm font-medium text-green-600", children: status }),
    /* @__PURE__ */ jsxs("form", { onSubmit: submit, children: [
      /* @__PURE__ */ jsx(
        TextInput,
        {
          id: "email",
          type: "email",
          name: "email",
          value: data.email,
          className: "mt-1 block w-full",
          isFocused: true,
          onChange: (e) => setData("email", e.target.value)
        }
      ),
      /* @__PURE__ */ jsx(InputError, { message: errors.email, className: "mt-2" }),
      /* @__PURE__ */ jsx("div", { className: "mt-4 flex items-center justify-end", children: /* @__PURE__ */ jsx(PrimaryButton, { className: "ms-4", disabled: processing, children: "Email Password Reset Link" }) })
    ] })
  ] });
}
const __vite_glob_0_2 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: ForgotPassword
}, Symbol.toStringTag, { value: "Module" }));
function Checkbox({ className = "", ...props }) {
  return /* @__PURE__ */ jsx(
    "input",
    {
      ...props,
      type: "checkbox",
      className: "rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 " + className
    }
  );
}
function Login({ status, canResetPassword }) {
  const { data, setData, post, processing, errors, reset } = useForm({
    email: "",
    password: "",
    remember: false
  });
  const submit = (e) => {
    e.preventDefault();
    post("/login", {
      onFinish: () => reset("password")
    });
  };
  return /* @__PURE__ */ jsxs(GuestLayout, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Log in" }),
    status && /* @__PURE__ */ jsx("div", { className: "mb-4 text-sm font-medium text-green-600", children: status }),
    /* @__PURE__ */ jsx("div", { className: "mb-4 underline", children: /* @__PURE__ */ jsx(Link, { href: `/local-login/superadmin@frozenza.com`, children: "Login as Super Admin" }) }),
    /* @__PURE__ */ jsxs("form", { onSubmit: submit, children: [
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "email", value: "Email" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "email",
            type: "email",
            name: "email",
            value: data.email,
            className: "mt-1 block w-full",
            autoComplete: "username",
            isFocused: true,
            onChange: (e) => setData("email", e.target.value)
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.email, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-4", children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "password", value: "Password" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "password",
            type: "password",
            name: "password",
            value: data.password,
            className: "mt-1 block w-full",
            autoComplete: "current-password",
            onChange: (e) => setData("password", e.target.value)
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.password, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsx("div", { className: "mt-4 block", children: /* @__PURE__ */ jsxs("label", { className: "flex items-center", children: [
        /* @__PURE__ */ jsx(
          Checkbox,
          {
            name: "remember",
            checked: data.remember,
            onChange: (e) => setData("remember", e.target.checked)
          }
        ),
        /* @__PURE__ */ jsx("span", { className: "ms-2 text-sm text-gray-600", children: "Remember me" })
      ] }) }),
      /* @__PURE__ */ jsxs("div", { className: "mt-4 flex items-center justify-between", children: [
        canResetPassword && /* @__PURE__ */ jsx(
          Link,
          {
            href: `/password-reset`,
            className: "rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",
            children: "Forgot your password?"
          }
        ),
        /* @__PURE__ */ jsxs("div", { className: "flex items-center gap-3", children: [
          /* @__PURE__ */ jsx(PrimaryButton, { disabled: processing, children: "Log in" }),
          /* @__PURE__ */ jsx("span", { className: "text-gray-500", children: "or" }),
          /* @__PURE__ */ jsx(
            Link,
            {
              href: `/register`,
              className: "rounded-md text-sm font-semibold text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",
              children: "Register now"
            }
          )
        ] })
      ] })
    ] }),
    /* @__PURE__ */ jsxs("div", { className: "mt-6", children: [
      /* @__PURE__ */ jsxs("div", { className: "relative", children: [
        /* @__PURE__ */ jsx("div", { className: "absolute inset-0 flex items-center", children: /* @__PURE__ */ jsx("div", { className: "w-full border-t border-gray-300" }) }),
        /* @__PURE__ */ jsx("div", { className: "relative flex justify-center text-sm", children: /* @__PURE__ */ jsx("span", { className: "bg-white px-2 text-gray-500", children: "Or continue with" }) })
      ] }),
      /* @__PURE__ */ jsx("div", { className: "flex py-4", children: /* @__PURE__ */ jsxs(
        "a",
        {
          href: `/social-auth/google`,
          className: "flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-1.5 text-gray-900 border border-gray-200 hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4285F4]",
          children: [
            /* @__PURE__ */ jsx(GoogleIcon, { className: "h-5 w-5" }),
            /* @__PURE__ */ jsx("span", { className: "text-sm font-semibold leading-6", children: "Google" })
          ]
        }
      ) })
    ] })
  ] });
}
const __vite_glob_0_3 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: Login
}, Symbol.toStringTag, { value: "Module" }));
function Register() {
  const { data, setData, post, processing, errors, reset } = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
  });
  const submit = (e) => {
    e.preventDefault();
    post("/register", {
      onFinish: () => reset("password", "password_confirmation")
    });
  };
  return /* @__PURE__ */ jsxs(GuestLayout, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Register" }),
    /* @__PURE__ */ jsxs("form", { onSubmit: submit, children: [
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "name", value: "Name" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "name",
            name: "name",
            value: data.name,
            className: "mt-1 block w-full",
            autoComplete: "name",
            isFocused: true,
            onChange: (e) => setData("name", e.target.value),
            required: true
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.name, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-4", children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "email", value: "Email" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "email",
            type: "email",
            name: "email",
            value: data.email,
            className: "mt-1 block w-full",
            autoComplete: "username",
            onChange: (e) => setData("email", e.target.value),
            required: true
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.email, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-4", children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "password", value: "Password" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "password",
            type: "password",
            name: "password",
            value: data.password,
            className: "mt-1 block w-full",
            autoComplete: "new-password",
            onChange: (e) => setData("password", e.target.value),
            required: true
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.password, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-4", children: [
        /* @__PURE__ */ jsx(
          InputLabel,
          {
            htmlFor: "password_confirmation",
            value: "Confirm Password"
          }
        ),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "password_confirmation",
            type: "password",
            name: "password_confirmation",
            value: data.password_confirmation,
            className: "mt-1 block w-full",
            autoComplete: "new-password",
            onChange: (e) => setData("password_confirmation", e.target.value),
            required: true
          }
        ),
        /* @__PURE__ */ jsx(
          InputError,
          {
            message: errors.password_confirmation,
            className: "mt-2"
          }
        )
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-4 flex items-center justify-end", children: [
        /* @__PURE__ */ jsx(
          Link,
          {
            href: `/login`,
            className: "rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",
            children: "Already registered?"
          }
        ),
        /* @__PURE__ */ jsx(PrimaryButton, { className: "ms-4", disabled: processing, children: "Register" })
      ] })
    ] })
  ] });
}
const __vite_glob_0_4 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: Register
}, Symbol.toStringTag, { value: "Module" }));
function ResetPassword({ token, email }) {
  const { data, setData, post, processing, errors, reset } = useForm({
    token,
    email,
    password: "",
    password_confirmation: ""
  });
  const submit = (e) => {
    e.preventDefault();
    post(route("password.store"), {
      onFinish: () => reset("password", "password_confirmation")
    });
  };
  return /* @__PURE__ */ jsxs(GuestLayout, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Reset Password" }),
    /* @__PURE__ */ jsxs("form", { onSubmit: submit, children: [
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "email", value: "Email" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "email",
            type: "email",
            name: "email",
            value: data.email,
            className: "mt-1 block w-full",
            autoComplete: "username",
            onChange: (e) => setData("email", e.target.value)
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.email, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-4", children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "password", value: "Password" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "password",
            type: "password",
            name: "password",
            value: data.password,
            className: "mt-1 block w-full",
            autoComplete: "new-password",
            isFocused: true,
            onChange: (e) => setData("password", e.target.value)
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.password, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-4", children: [
        /* @__PURE__ */ jsx(
          InputLabel,
          {
            htmlFor: "password_confirmation",
            value: "Confirm Password"
          }
        ),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            type: "password",
            id: "password_confirmation",
            name: "password_confirmation",
            value: data.password_confirmation,
            className: "mt-1 block w-full",
            autoComplete: "new-password",
            onChange: (e) => setData("password_confirmation", e.target.value)
          }
        ),
        /* @__PURE__ */ jsx(
          InputError,
          {
            message: errors.password_confirmation,
            className: "mt-2"
          }
        )
      ] }),
      /* @__PURE__ */ jsx("div", { className: "mt-4 flex items-center justify-end", children: /* @__PURE__ */ jsx(PrimaryButton, { className: "ms-4", disabled: processing, children: "Reset Password" }) })
    ] })
  ] });
}
const __vite_glob_0_5 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: ResetPassword
}, Symbol.toStringTag, { value: "Module" }));
function VerifyEmail({ status }) {
  const { post, processing } = useForm({});
  const submit = (e) => {
    e.preventDefault();
    post(route("verification.send"));
  };
  return /* @__PURE__ */ jsxs(GuestLayout, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Email Verification" }),
    /* @__PURE__ */ jsx("div", { className: "mb-4 text-sm text-gray-600", children: "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another." }),
    status === "verification-link-sent" && /* @__PURE__ */ jsx("div", { className: "mb-4 text-sm font-medium text-green-600", children: "A new verification link has been sent to the email address you provided during registration." }),
    /* @__PURE__ */ jsx("form", { onSubmit: submit, children: /* @__PURE__ */ jsxs("div", { className: "mt-4 flex items-center justify-between", children: [
      /* @__PURE__ */ jsx(PrimaryButton, { disabled: processing, children: "Resend Verification Email" }),
      /* @__PURE__ */ jsx(
        Link,
        {
          href: route("logout"),
          method: "post",
          as: "button",
          className: "rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",
          children: "Log Out"
        }
      )
    ] }) })
  ] });
}
const __vite_glob_0_6 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: VerifyEmail
}, Symbol.toStringTag, { value: "Module" }));
function route$1(name, params) {
  return `/${name.replace(".", "/")}`;
}
function BlogIndex({ posts, meta, auth }) {
  return /* @__PURE__ */ jsx(MainLayout, { meta, auth, children: /* @__PURE__ */ jsxs("div", { className: "max-w-7xl mx-auto", children: [
    /* @__PURE__ */ jsxs("div", { className: "flex justify-between items-center mb-8", children: [
      /* @__PURE__ */ jsx("h1", { className: "text-3xl font-bold", children: "Blog Posts" }),
      auth.user && /* @__PURE__ */ jsx(
        Link,
        {
          href: route$1("blog.create"),
          className: "bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600",
          children: "Write New Post"
        }
      )
    ] }),
    /* @__PURE__ */ jsx("div", { className: "grid gap-8 md:grid-cols-2 lg:grid-cols-3", children: posts.data.map((post) => /* @__PURE__ */ jsxs(
      Link,
      {
        href: `/blogs/${post.slug}`,
        className: "bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow",
        children: [
          post.feature_image && /* @__PURE__ */ jsx(
            "img",
            {
              src: post.feature_image,
              alt: post.title,
              className: "w-full h-48 object-cover"
            }
          ),
          /* @__PURE__ */ jsxs("div", { className: "p-6", children: [
            /* @__PURE__ */ jsx("h2", { className: "text-xl font-bold mb-2", children: post.title }),
            /* @__PURE__ */ jsxs("p", { className: "text-gray-600 mb-4", children: [
              post.meta_description.substring(0, 150),
              "..."
            ] }),
            /* @__PURE__ */ jsxs("div", { className: "flex justify-between items-center text-sm text-gray-500", children: [
              /* @__PURE__ */ jsx("span", { children: "By Charles Gilchrist" }),
              /* @__PURE__ */ jsx("span", { children: new Date(post.published_at).toLocaleDateString() })
            ] })
          ] })
        ]
      },
      post.id
    )) }),
    /* @__PURE__ */ jsx("div", { className: "mt-8 flex justify-center gap-2", children: posts.links.map((link, i) => /* @__PURE__ */ jsx(
      Link,
      {
        href: link.url || "#",
        className: `px-4 py-2 rounded ${link.active ? "bg-blue-500 text-white" : "bg-white text-gray-700 hover:bg-gray-50"} ${!link.url ? "opacity-50 cursor-not-allowed" : ""}`,
        dangerouslySetInnerHTML: { __html: link.label }
      },
      i
    )) })
  ] }) });
}
const __vite_glob_0_7 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: BlogIndex
}, Symbol.toStringTag, { value: "Module" }));
function getImageUrl(image) {
  return "/storage/" + image.path + "/" + image.name;
}
function SchemaMarkup({ type, data }) {
  const generatePizzaSchema = (pizza) => {
    var _a;
    return {
      "@context": "https://schema.org",
      "@type": "Product",
      name: pizza.name,
      description: pizza.description,
      image: pizza.image_url,
      brand: {
        "@type": "Brand",
        name: pizza.brand.name
      },
      style: {
        "@type": "ProductModel",
        name: ((_a = pizza == null ? void 0 : pizza.style) == null ? void 0 : _a.name) || void 0
      },
      aggregateRating: pizza.total_reviews > 0 ? {
        "@type": "AggregateRating",
        ratingValue: pizza.average_rating,
        reviewCount: pizza.total_reviews
      } : void 0,
      nutrition: (pizza == null ? void 0 : pizza.nutrition_fact) ? {
        "@type": "NutritionInformation",
        calories: `${pizza.nutrition_fact.calories} calories`,
        proteinContent: pizza.nutrition_fact.protein,
        carbohydrateContent: pizza.nutrition_fact.total_carbohydrate,
        fatContent: pizza.nutrition_fact.total_fat,
        saturatedFatContent: pizza.nutrition_fact.saturated_fat,
        transFatContent: pizza.nutrition_fact.trans_fat,
        cholesterolContent: pizza.nutrition_fact.cholesterol,
        sodiumContent: pizza.nutrition_fact.sodium,
        dietaryFiberContent: pizza.nutrition_fact.dietary_fiber,
        sugarContent: pizza.nutrition_fact.total_sugars,
        addedSugarContent: pizza.nutrition_fact.added_sugars,
        vitaminDContent: pizza.nutrition_fact.vitamin_d,
        calciumContent: pizza.nutrition_fact.calcium,
        ironContent: pizza.nutrition_fact.iron,
        potassiumContent: pizza.nutrition_fact.potassium,
        monounsaturatedFatContent: pizza.nutrition_fact.monounsaturated_fat || void 0,
        polyunsaturatedFatContent: pizza.nutrition_fact.polyunsaturated_fat || void 0,
        vitaminAContent: pizza.nutrition_fact.vitamin_a || void 0,
        vitaminCContent: pizza.nutrition_fact.vitamin_c || void 0
      } : void 0
    };
  };
  const generateBrandSchema = (brand) => ({
    "@context": "https://schema.org",
    "@type": "Brand",
    name: brand.name,
    description: brand.description,
    url: brand.website,
    image: getImageUrl(brand.image)
  });
  const generateReviewSchema = (review) => ({
    "@context": "https://schema.org",
    "@type": "Review",
    reviewRating: {
      "@type": "Rating",
      ratingValue: review.rating
    },
    author: {
      "@type": "Person",
      name: review.user.name
    },
    datePublished: review.created_at,
    reviewBody: review.review,
    itemReviewed: {
      "@type": "Product",
      name: review.pizza.name
    }
  });
  const schemaGenerators = {
    Pizza: generatePizzaSchema,
    Brand: generateBrandSchema,
    Review: generateReviewSchema
  };
  const generator = schemaGenerators[type];
  if (!generator) {
    console.error(`Unknown schema type: ${type}`);
    return null;
  }
  return /* @__PURE__ */ jsx(Head, { children: /* @__PURE__ */ jsx(
    "script",
    {
      type: "application/ld+json",
      dangerouslySetInnerHTML: {
        __html: JSON.stringify(generator(data))
      }
    }
  ) });
}
function PizzaListItem({ pizza }) {
  var _a, _b;
  const mainImage = ((_a = pizza == null ? void 0 : pizza.images) == null ? void 0 : _a.find((image) => image.pivot.type === "main")) ?? null;
  const brandLogo = ((_b = pizza == null ? void 0 : pizza.brand) == null ? void 0 : _b.image) ? getImageUrl(pizza.brand.image) : "/storage/assets/brand_placeholder.png";
  const pizzaUrl = `/pizzas/${pizza.brand.slug}/${pizza.slug}`;
  return /* @__PURE__ */ jsxs(Fragment, { children: [
    /* @__PURE__ */ jsx(SchemaMarkup, { type: "Pizza", data: pizza }),
    /* @__PURE__ */ jsx(Link, { href: pizzaUrl, className: "block h-full", children: /* @__PURE__ */ jsxs("div", { className: "bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow h-full flex flex-col", children: [
      /* @__PURE__ */ jsx("div", { className: "relative aspect-square", children: /* @__PURE__ */ jsx(
        "img",
        {
          src: mainImage ? getImageUrl(mainImage) : "/storage/assets/pizza_placeholder.png",
          alt: pizza.name,
          title: pizza.name,
          className: "w-full h-full object-cover p-3",
          width: mainImage == null ? void 0 : mainImage.width,
          height: mainImage == null ? void 0 : mainImage.height,
          loading: "lazy"
        }
      ) }),
      /* @__PURE__ */ jsxs("div", { className: "p-4 flex-grow flex flex-col", children: [
        /* @__PURE__ */ jsxs("div", { className: "flex items-center gap-3 mb-2", children: [
          /* @__PURE__ */ jsx(
            "img",
            {
              src: brandLogo,
              alt: `${pizza.brand.name} logo`,
              className: "w-16 h-16 rounded-full object-contain bg-gray-50",
              loading: "lazy"
            }
          ),
          /* @__PURE__ */ jsxs("div", { children: [
            /* @__PURE__ */ jsx("h3", { className: "font-semibold text-lg leading-tight", children: pizza.name }),
            /* @__PURE__ */ jsx("p", { className: "text-gray-600 text-sm", children: pizza.brand.name })
          ] })
        ] }),
        /* @__PURE__ */ jsx("div", { className: "flex items-center justify-end mb-2", children: /* @__PURE__ */ jsxs("div", { className: "flex items-center", children: [
          /* @__PURE__ */ jsx("span", { className: "text-yellow-400", children: "★" }),
          /* @__PURE__ */ jsx("span", { className: "ml-1", children: pizza.average_rating || "No reviews" })
        ] }) }),
        pizza.tags && pizza.tags.length > 0 && /* @__PURE__ */ jsx("div", { className: "flex flex-wrap gap-2 mt-auto pt-2", children: pizza.tags.map((tag, index) => /* @__PURE__ */ jsx(
          "span",
          {
            className: "px-2 py-1 bg-gray-100 text-sm rounded-full text-gray-600",
            children: tag.slug
          },
          index
        )) })
      ] })
    ] }) })
  ] });
}
function BlogShow({ post, content, pizzas, meta, auth }) {
  var _a;
  return /* @__PURE__ */ jsx(MainLayout, { meta, auth, children: /* @__PURE__ */ jsx("div", { className: "blog max-w-7xl mx-auto flex", children: /* @__PURE__ */ jsxs("article", { className: "bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex", children: [
    post.featured_image && /* @__PURE__ */ jsx(
      "img",
      {
        src: post.featured_image,
        alt: post.title,
        className: "w-full h-64 object-cover"
      }
    ),
    /* @__PURE__ */ jsxs("div", { className: "p-6", children: [
      /* @__PURE__ */ jsx("h1", { className: "text-3xl font-bold mb-4", children: post.title }),
      /* @__PURE__ */ jsxs("div", { className: "flex justify-between items-center text-sm text-gray-500 mb-8", children: [
        /* @__PURE__ */ jsx("span", { children: "By Charles Gilchrist" }),
        /* @__PURE__ */ jsx("span", { children: new Date(post.published_at).toLocaleDateString() })
      ] }),
      /* @__PURE__ */ jsx(
        "div",
        {
          className: "prose max-w-none",
          dangerouslySetInnerHTML: { __html: content }
        }
      ),
      ((_a = post.tags) == null ? void 0 : _a.length) > 0 && /* @__PURE__ */ jsx("div", { className: "mt-8 pt-4 border-t", children: /* @__PURE__ */ jsx("div", { className: "flex gap-2", children: post.tags.map((tag, index) => /* @__PURE__ */ jsx(
        "span",
        {
          className: "px-3 py-1 bg-gray-100 rounded-full text-sm",
          children: tag
        },
        index
      )) }) })
    ] }),
    /* @__PURE__ */ jsxs("div", { className: "hidden md:block max-w-[310px]", children: [
      /* @__PURE__ */ jsx("h2", { className: "text-xl font-bold mb-4 text-center", children: "Top-Rated Pizzas" }),
      /* @__PURE__ */ jsx("ul", { className: "space-y-4 px-2", children: (pizzas == null ? void 0 : pizzas.data) && pizzas.data.map((pizza) => /* @__PURE__ */ jsx(PizzaListItem, { pizza }, pizza.id)) })
    ] })
  ] }) }) });
}
const __vite_glob_0_8 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: BlogShow
}, Symbol.toStringTag, { value: "Module" }));
function BreadcrumbSchema({ items }) {
  const schema = {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": items.map((item, index) => ({
      "@type": "ListItem",
      "position": index + 1,
      "item": {
        "@id": `${"http://127.0.0.1:8001"}${item.url}`,
        "name": item.name
      }
    }))
  };
  return /* @__PURE__ */ jsx(Head, { children: /* @__PURE__ */ jsx(
    "script",
    {
      type: "application/ld+json",
      dangerouslySetInnerHTML: {
        __html: JSON.stringify(schema)
      }
    }
  ) });
}
function BrandListItem({ brand }) {
  return /* @__PURE__ */ jsxs(Fragment, { children: [
    /* @__PURE__ */ jsx(SchemaMarkup, { type: "Brand", data: brand }),
    /* @__PURE__ */ jsx(
      Link,
      {
        href: `/brands/${brand.slug}/pizzas`,
        className: "block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all hover:translate-y-[-2px] h-full",
        children: /* @__PURE__ */ jsxs("div", { className: "p-4 flex flex-col items-center justify-between h-full", children: [
          (brand == null ? void 0 : brand.image) && /* @__PURE__ */ jsx(
            "img",
            {
              src: getImageUrl(brand.image),
              alt: brand.name,
              title: brand.name,
              className: "w-full h-32 object-contain mb-4",
              width: brand.image.width,
              height: brand.image.height,
              loading: "lazy"
            }
          ),
          /* @__PURE__ */ jsxs("div", { className: "flex items-center justify-center mt-auto bg-gradient-to-r from-red-500 to-orange-500 text-white py-2 px-4 rounded-full shadow-sm", children: [
            /* @__PURE__ */ jsx(PizzaIcon, { className: "w-5 h-5 text-white mr-2" }),
            /* @__PURE__ */ jsxs("span", { className: "font-semibold", children: [
              brand.pizzas_count,
              " Pizzas"
            ] })
          ] })
        ] })
      }
    )
  ] });
}
function BrandsIndex({ brands, meta, auth }) {
  return /* @__PURE__ */ jsxs(MainLayout, { meta, auth, children: [
    /* @__PURE__ */ jsx(
      BreadcrumbSchema,
      {
        items: [
          { name: "Home", url: "/" },
          { name: "Frozen Pizza Brands", url: "/brands" }
        ]
      }
    ),
    /* @__PURE__ */ jsxs("div", { className: "max-w-7xl mx-auto", children: [
      /* @__PURE__ */ jsx("h1", { className: "text-4xl font-bold mb-6", children: "The Worlds Frozen Pizza Brands" }),
      /* @__PURE__ */ jsx("div", { className: "prose max-w-none mb-8", children: /* @__PURE__ */ jsx("p", { className: "text-lg", children: "Discover the best frozen pizza brands, from artisanal wood-fired pizzas to classic favorites. We provide detailed reviews, nutritional information, and honest feedback from real pizza lovers." }) }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("h2", { className: "text-2xl font-semibold mb-6", children: "All Brands" }),
        /* @__PURE__ */ jsx("div", { className: "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4", children: brands.map((brand) => /* @__PURE__ */ jsx(
          BrandListItem,
          {
            brand
          },
          brand.id
        )) })
      ] })
    ] })
  ] });
}
const __vite_glob_0_9 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: BrandsIndex
}, Symbol.toStringTag, { value: "Module" }));
function BrandShow({ brand, meta, auth }) {
  return /* @__PURE__ */ jsxs(MainLayout, { meta, auth, children: [
    /* @__PURE__ */ jsx(
      SchemaMarkup,
      {
        type: "Brand",
        data: brand
      }
    ),
    /* @__PURE__ */ jsx(
      BreadcrumbSchema,
      {
        items: [
          { name: "Home", url: "/" },
          { name: "Brands", url: "/brands" },
          { name: brand.name, url: `/brands/${brand.slug}` }
        ]
      }
    ),
    /* @__PURE__ */ jsx("div", { className: "bg-white shadow-lg rounded-lg overflow-hidden mb-8", children: /* @__PURE__ */ jsx("div", { className: "p-6", children: /* @__PURE__ */ jsxs("div", { className: "flex flex-col sm:flex-row items-center sm:items-start gap-6", children: [
      (brand == null ? void 0 : brand.image) && /* @__PURE__ */ jsx("div", { className: "flex-shrink-0", children: /* @__PURE__ */ jsx(
        "img",
        {
          title: brand.name + " logo",
          src: getImageUrl(brand.image),
          alt: `${brand.name} logo`,
          className: "w-32 h-32 object-contain",
          width: brand.image.width,
          height: brand.image.height,
          loading: "lazy"
        }
      ) }),
      /* @__PURE__ */ jsxs("div", { className: "text-center sm:text-left flex-1", children: [
        /* @__PURE__ */ jsx("h1", { className: "text-3xl font-bold mb-2", children: `${brand.name} - Frozen Pizza` }),
        /* @__PURE__ */ jsxs("div", { className: "prose prose-sm sm:prose lg:prose-lg max-w-none", children: [
          /* @__PURE__ */ jsx("div", { className: "text-gray-600 mb-4 whitespace-pre-wrap", children: brand.description }),
          brand.brand_story && /* @__PURE__ */ jsxs(Fragment, { children: [
            /* @__PURE__ */ jsxs("h2", { className: "text-xl font-semibold mt-4 mb-2", children: [
              "About ",
              brand.name
            ] }),
            /* @__PURE__ */ jsx("div", { className: "text-gray-600 whitespace-pre-wrap", children: brand.brand_story })
          ] })
        ] }),
        brand.website && /* @__PURE__ */ jsxs(
          "a",
          {
            href: brand.website,
            target: "_blank",
            rel: "noopener noreferrer",
            className: "text-blue-600 hover:underline inline-flex items-center gap-1",
            children: [
              /* @__PURE__ */ jsx("span", { children: brand.website }),
              /* @__PURE__ */ jsx(ExternalLinkIcon, { className: "w-4 h-4" })
            ]
          }
        )
      ] })
    ] }) }) }),
    /* @__PURE__ */ jsx("div", { className: "flex items-center justify-between mb-6", children: /* @__PURE__ */ jsxs("h2", { className: "text-2xl font-bold", children: [
      brand.name,
      " Frozen Pizza Selection (",
      brand.pizzas.length,
      " Varieties)"
    ] }) }),
    /* @__PURE__ */ jsx("div", { className: "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6", children: brand.pizzas.length > 0 ? brand.pizzas.map((pizza) => /* @__PURE__ */ jsx(PizzaListItem, { pizza }, pizza.id)) : /* @__PURE__ */ jsx("p", { className: "text-gray-600", children: "No pizzas found for this brand." }) })
  ] });
}
const __vite_glob_0_10 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: BrandShow
}, Symbol.toStringTag, { value: "Module" }));
function ContactForm({ auth }) {
  var _a, _b, _c;
  const { data, setData, post, processing, errors, reset } = useForm({
    name: ((_a = auth == null ? void 0 : auth.user) == null ? void 0 : _a.name) || "",
    email: ((_b = auth == null ? void 0 : auth.user) == null ? void 0 : _b.email) || "",
    subject: "",
    message: "",
    user_id: ((_c = auth == null ? void 0 : auth.user) == null ? void 0 : _c.id) || ""
  });
  const [isSuccess, setIsSuccess] = useState(false);
  useEffect(() => {
    if (auth == null ? void 0 : auth.user) {
      setData((data2) => ({
        ...data2,
        name: auth.user.name,
        email: auth.user.email,
        user_id: auth.user.id
      }));
    }
  }, [auth]);
  const handleSubmit = (e) => {
    e.preventDefault();
    post("/contact", {
      onSuccess: () => {
        setIsSuccess(true);
      }
    });
  };
  return /* @__PURE__ */ jsxs("div", { className: "max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md", children: [
    /* @__PURE__ */ jsx("h2", { className: "text-2xl font-bold text-gray-800 mb-6", children: "Contact Us" }),
    isSuccess ? /* @__PURE__ */ jsx("div", { className: "bg-green-50 border border-green-200 rounded-lg p-4 mb-6", children: /* @__PURE__ */ jsx("p", { className: "text-sm text-green-700", children: "Message sent successfully! We will get back to you as soon as possible." }) }) : /* @__PURE__ */ jsxs("form", { onSubmit: handleSubmit, className: "space-y-6", children: [
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("label", { htmlFor: "name", className: "block text-sm font-medium text-gray-700", children: "Name" }),
        /* @__PURE__ */ jsx(
          "input",
          {
            type: "text",
            id: "name",
            value: data.name,
            onChange: (e) => setData("name", e.target.value),
            className: "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",
            required: true,
            readOnly: !!(auth == null ? void 0 : auth.user)
          }
        ),
        errors.name && /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-red-600", children: errors.name })
      ] }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("label", { htmlFor: "email", className: "block text-sm font-medium text-gray-700", children: "Email" }),
        /* @__PURE__ */ jsx(
          "input",
          {
            type: "email",
            id: "email",
            value: data.email,
            onChange: (e) => setData("email", e.target.value),
            className: "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",
            required: true,
            readOnly: !!(auth == null ? void 0 : auth.user)
          }
        ),
        errors.email && /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-red-600", children: errors.email })
      ] }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("label", { htmlFor: "subject", className: "block text-sm font-medium text-gray-700", children: "Subject" }),
        /* @__PURE__ */ jsx(
          "input",
          {
            type: "text",
            id: "subject",
            value: data.subject,
            onChange: (e) => setData("subject", e.target.value),
            className: "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",
            required: true
          }
        ),
        errors.subject && /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-red-600", children: errors.subject })
      ] }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("label", { htmlFor: "message", className: "block text-sm font-medium text-gray-700", children: "Message" }),
        /* @__PURE__ */ jsx(
          "textarea",
          {
            id: "message",
            value: data.message,
            onChange: (e) => setData("message", e.target.value),
            rows: 4,
            className: "mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",
            required: true
          }
        ),
        errors.message && /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-red-600", children: errors.message })
      ] }),
      /* @__PURE__ */ jsx("div", { children: /* @__PURE__ */ jsx(
        "button",
        {
          type: "submit",
          disabled: processing,
          className: "w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50",
          children: processing ? "Sending..." : "Send Message"
        }
      ) })
    ] })
  ] });
}
function Contact({ auth }) {
  return /* @__PURE__ */ jsxs(MainLayout, { auth, children: [
    /* @__PURE__ */ jsx(Head, { title: "Contact Us" }),
    /* @__PURE__ */ jsx("div", { className: "py-12", children: /* @__PURE__ */ jsxs("div", { className: "max-w-7xl mx-auto sm:px-6 lg:px-8", children: [
      !(auth == null ? void 0 : auth.user) && /* @__PURE__ */ jsx("div", { className: "bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6", children: /* @__PURE__ */ jsxs("div", { className: "flex items-center justify-between", children: [
        /* @__PURE__ */ jsx("div", { className: "flex-1", children: /* @__PURE__ */ jsx("p", { className: "text-sm text-blue-700", children: "Have an account? Log in to automatically fill your contact information." }) }),
        /* @__PURE__ */ jsx("div", { className: "ml-4", children: /* @__PURE__ */ jsx(
          Link,
          {
            href: "/login",
            className: "inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500",
            children: "Log in"
          }
        ) })
      ] }) }),
      /* @__PURE__ */ jsx("div", { className: "bg-white overflow-hidden shadow-sm sm:rounded-lg", children: /* @__PURE__ */ jsxs("div", { className: "p-6", children: [
        /* @__PURE__ */ jsx("h1", { className: "text-3xl font-bold text-gray-900 mb-8 text-center", children: "Get in Touch" }),
        /* @__PURE__ */ jsx("p", { className: "text-gray-600 text-center mb-8", children: "Have a question, suggestion, or feedback? We'd love to hear from you!" }),
        /* @__PURE__ */ jsx(ContactForm, { auth })
      ] }) })
    ] }) })
  ] });
}
const __vite_glob_0_11 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: Contact
}, Symbol.toStringTag, { value: "Module" }));
const DropDownContext = createContext();
const Dropdown = ({ children }) => {
  const [open, setOpen] = useState(false);
  const toggleOpen = () => {
    setOpen((previousState) => !previousState);
  };
  return /* @__PURE__ */ jsx(DropDownContext.Provider, { value: { open, setOpen, toggleOpen }, children: /* @__PURE__ */ jsx("div", { className: "relative", children }) });
};
const Trigger = ({ children }) => {
  const { open, setOpen, toggleOpen } = useContext(DropDownContext);
  return /* @__PURE__ */ jsxs(Fragment, { children: [
    /* @__PURE__ */ jsx("div", { onClick: toggleOpen, children }),
    open && /* @__PURE__ */ jsx(
      "div",
      {
        className: "fixed inset-0 z-40",
        onClick: () => setOpen(false)
      }
    )
  ] });
};
const Content = ({
  align = "right",
  width = "48",
  contentClasses = "py-1 bg-white",
  children
}) => {
  const { open, setOpen } = useContext(DropDownContext);
  let alignmentClasses = "origin-top";
  if (align === "left") {
    alignmentClasses = "ltr:origin-top-left rtl:origin-top-right start-0";
  } else if (align === "right") {
    alignmentClasses = "ltr:origin-top-right rtl:origin-top-left end-0";
  }
  let widthClasses = "";
  if (width === "48") {
    widthClasses = "w-48";
  }
  return /* @__PURE__ */ jsx(Fragment, { children: /* @__PURE__ */ jsx(
    Transition,
    {
      show: open,
      enter: "transition ease-out duration-200",
      enterFrom: "opacity-0 scale-95",
      enterTo: "opacity-100 scale-100",
      leave: "transition ease-in duration-75",
      leaveFrom: "opacity-100 scale-100",
      leaveTo: "opacity-0 scale-95",
      children: /* @__PURE__ */ jsx(
        "div",
        {
          className: `absolute z-50 mt-2 rounded-md shadow-lg ${alignmentClasses} ${widthClasses}`,
          onClick: () => setOpen(false),
          children: /* @__PURE__ */ jsx(
            "div",
            {
              className: `rounded-md ring-1 ring-black ring-opacity-5 ` + contentClasses,
              children
            }
          )
        }
      )
    }
  ) });
};
const DropdownLink = ({ className = "", children, ...props }) => {
  return /* @__PURE__ */ jsx(
    Link,
    {
      ...props,
      className: "block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none " + className,
      children
    }
  );
};
Dropdown.Trigger = Trigger;
Dropdown.Content = Content;
Dropdown.Link = DropdownLink;
function NavLink({
  active = false,
  className = "",
  children,
  ...props
}) {
  return /* @__PURE__ */ jsx(
    Link,
    {
      ...props,
      className: "inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none " + (active ? "border-indigo-400 text-gray-900 focus:border-indigo-700" : "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:border-gray-300 focus:text-gray-700") + className,
      children
    }
  );
}
function ResponsiveNavLink({
  active = false,
  className = "",
  children,
  ...props
}) {
  return /* @__PURE__ */ jsx(
    Link,
    {
      ...props,
      className: `flex w-full items-start border-l-4 py-2 pe-4 ps-3 ${active ? "border-indigo-400 bg-indigo-50 text-indigo-700 focus:border-indigo-700 focus:bg-indigo-100 focus:text-indigo-800" : "border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800 focus:border-gray-300 focus:bg-gray-50 focus:text-gray-800"} text-base font-medium transition duration-150 ease-in-out focus:outline-none ${className}`,
      children
    }
  );
}
function AuthenticatedLayout({ header, children }) {
  const user = usePage().props.auth.user;
  const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
  return /* @__PURE__ */ jsxs("div", { className: "min-h-screen bg-gray-100", children: [
    /* @__PURE__ */ jsxs("nav", { className: "border-b border-gray-100 bg-white", children: [
      /* @__PURE__ */ jsx("div", { className: "mx-auto max-w-7xl px-4 sm:px-6 lg:px-8", children: /* @__PURE__ */ jsxs("div", { className: "flex h-16 justify-between", children: [
        /* @__PURE__ */ jsxs("div", { className: "flex", children: [
          /* @__PURE__ */ jsx("div", { className: "flex shrink-0 items-center", children: /* @__PURE__ */ jsx(Link, { href: "/", children: /* @__PURE__ */ jsx(ApplicationLogo, { className: "block h-9 w-auto fill-current text-gray-800" }) }) }),
          /* @__PURE__ */ jsx("div", { className: "hidden space-x-8 sm:-my-px sm:ms-10 sm:flex", children: /* @__PURE__ */ jsx(
            NavLink,
            {
              href: route("dashboard"),
              active: route().current("dashboard"),
              children: "Dashboard"
            }
          ) })
        ] }),
        /* @__PURE__ */ jsx("div", { className: "hidden sm:ms-6 sm:flex sm:items-center", children: /* @__PURE__ */ jsx("div", { className: "relative ms-3", children: /* @__PURE__ */ jsxs(Dropdown, { children: [
          /* @__PURE__ */ jsx(Dropdown.Trigger, { children: /* @__PURE__ */ jsx("span", { className: "inline-flex rounded-md", children: /* @__PURE__ */ jsxs(
            "button",
            {
              type: "button",
              className: "inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none",
              children: [
                user.name,
                /* @__PURE__ */ jsx(
                  "svg",
                  {
                    className: "-me-0.5 ms-2 h-4 w-4",
                    xmlns: "http://www.w3.org/2000/svg",
                    viewBox: "0 0 20 20",
                    fill: "currentColor",
                    children: /* @__PURE__ */ jsx(
                      "path",
                      {
                        fillRule: "evenodd",
                        d: "M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z",
                        clipRule: "evenodd"
                      }
                    )
                  }
                )
              ]
            }
          ) }) }),
          /* @__PURE__ */ jsxs(Dropdown.Content, { children: [
            /* @__PURE__ */ jsx(
              Dropdown.Link,
              {
                href: route("profile.edit"),
                children: "Profile"
              }
            ),
            /* @__PURE__ */ jsx(
              Dropdown.Link,
              {
                href: route("logout"),
                method: "post",
                as: "button",
                children: "Log Out"
              }
            )
          ] })
        ] }) }) }),
        /* @__PURE__ */ jsx("div", { className: "-me-2 flex items-center sm:hidden", children: /* @__PURE__ */ jsx(
          "button",
          {
            onClick: () => setShowingNavigationDropdown(
              (previousState) => !previousState
            ),
            className: "inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none",
            children: /* @__PURE__ */ jsxs(
              "svg",
              {
                className: "h-6 w-6",
                stroke: "currentColor",
                fill: "none",
                viewBox: "0 0 24 24",
                children: [
                  /* @__PURE__ */ jsx(
                    "path",
                    {
                      className: !showingNavigationDropdown ? "inline-flex" : "hidden",
                      strokeLinecap: "round",
                      strokeLinejoin: "round",
                      strokeWidth: "2",
                      d: "M4 6h16M4 12h16M4 18h16"
                    }
                  ),
                  /* @__PURE__ */ jsx(
                    "path",
                    {
                      className: showingNavigationDropdown ? "inline-flex" : "hidden",
                      strokeLinecap: "round",
                      strokeLinejoin: "round",
                      strokeWidth: "2",
                      d: "M6 18L18 6M6 6l12 12"
                    }
                  )
                ]
              }
            )
          }
        ) })
      ] }) }),
      /* @__PURE__ */ jsxs(
        "div",
        {
          className: (showingNavigationDropdown ? "block" : "hidden") + " sm:hidden",
          children: [
            /* @__PURE__ */ jsx("div", { className: "space-y-1 pb-3 pt-2", children: /* @__PURE__ */ jsx(
              ResponsiveNavLink,
              {
                href: route("dashboard"),
                active: route().current("dashboard"),
                children: "Dashboard"
              }
            ) }),
            /* @__PURE__ */ jsxs("div", { className: "border-t border-gray-200 pb-1 pt-4", children: [
              /* @__PURE__ */ jsxs("div", { className: "px-4", children: [
                /* @__PURE__ */ jsx("div", { className: "text-base font-medium text-gray-800", children: user.name }),
                /* @__PURE__ */ jsx("div", { className: "text-sm font-medium text-gray-500", children: user.email })
              ] }),
              /* @__PURE__ */ jsxs("div", { className: "mt-3 space-y-1", children: [
                /* @__PURE__ */ jsx(ResponsiveNavLink, { href: route("profile.edit"), children: "Profile" }),
                /* @__PURE__ */ jsx(
                  ResponsiveNavLink,
                  {
                    method: "post",
                    href: route("logout"),
                    as: "button",
                    children: "Log Out"
                  }
                )
              ] })
            ] })
          ]
        }
      )
    ] }),
    header && /* @__PURE__ */ jsx("header", { className: "bg-white shadow", children: /* @__PURE__ */ jsx("div", { className: "mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8", children: header }) }),
    /* @__PURE__ */ jsx("main", { children })
  ] });
}
function Dashboard() {
  return /* @__PURE__ */ jsxs(
    AuthenticatedLayout,
    {
      header: /* @__PURE__ */ jsx("h2", { className: "text-xl font-semibold leading-tight text-gray-800", children: "Dashboard" }),
      children: [
        /* @__PURE__ */ jsx(Head, { title: "Dashboard" }),
        /* @__PURE__ */ jsx("div", { className: "py-12", children: /* @__PURE__ */ jsx("div", { className: "mx-auto max-w-7xl sm:px-6 lg:px-8", children: /* @__PURE__ */ jsx("div", { className: "overflow-hidden bg-white shadow-sm sm:rounded-lg", children: /* @__PURE__ */ jsx("div", { className: "p-6 text-gray-900", children: "You're logged in!" }) }) }) })
      ]
    }
  );
}
const __vite_glob_0_12 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: Dashboard
}, Symbol.toStringTag, { value: "Module" }));
function PizzasIndex({ pizzasFirstPage, meta, auth }) {
  const [pizzas, setPizzas] = useState(pizzasFirstPage);
  const fetchPizzas = async () => {
    const page = pizzas.current_page + 1;
    const response = await axios.get(`/pizzas/list?page=${page}`);
    setPizzas(response.data);
  };
  useEffect(() => {
    const handleScroll = () => {
      if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
        fetchPizzas();
      }
    };
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, [pizzas]);
  return /* @__PURE__ */ jsx(MainLayout, { meta, auth, children: /* @__PURE__ */ jsxs("div", { className: "max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8", children: [
    /* @__PURE__ */ jsxs("div", { className: "text-center mb-12", children: [
      /* @__PURE__ */ jsx("div", { className: "flex justify-center mb-6", children: /* @__PURE__ */ jsx(ApplicationLogo, { className: "w-[260px] h-[260px]" }) }),
      /* @__PURE__ */ jsx("h1", { className: "text-4xl font-extrabold text-gray-900 mb-4", children: "Welcome to Pizza Kraken" }),
      /* @__PURE__ */ jsx("p", { className: "text-xl text-gray-600 max-w-3xl mx-auto", children: "Discover the world's most comprehensive frozen pizza database. From DiGiorno to Table 87 (and everything in between), explore thousands of frozen pizzas from brands across the globe. Rate, review, and find your next favorite slice!" }),
      /* @__PURE__ */ jsx(
        "a",
        {
          href: "https://discord.gg/YOUR-INVITE-LINK",
          target: "_blank",
          rel: "noopener noreferrer",
          className: "inline-block mt-6 px-6 py-3 bg-[#5865F2] hover:bg-[#4752C4] text-white font-semibold rounded-lg transition-colors duration-200",
          children: /* @__PURE__ */ jsxs("div", { className: "flex items-center space-x-2", children: [
            /* @__PURE__ */ jsx("svg", { className: "w-6 h-6", fill: "currentColor", viewBox: "0 0 24 24", children: /* @__PURE__ */ jsx("path", { d: "M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z" }) }),
            /* @__PURE__ */ jsx("span", { children: "Join our Discord" })
          ] })
        }
      )
    ] }),
    /* @__PURE__ */ jsx("h2", { className: "text-2xl font-bold mb-6", children: "Featured Pizzas" }),
    /* @__PURE__ */ jsx("div", { className: "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6", children: pizzas.data.map((pizza) => /* @__PURE__ */ jsx(PizzaListItem, { pizza }, pizza.id)) })
  ] }) });
}
const __vite_glob_0_13 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: PizzasIndex
}, Symbol.toStringTag, { value: "Module" }));
function Modal({
  children,
  show = false,
  maxWidth = "2xl",
  closeable = true,
  onClose = () => {
  }
}) {
  const close = () => {
    if (closeable) {
      onClose();
    }
  };
  const maxWidthClass = {
    sm: "sm:max-w-sm",
    md: "sm:max-w-md",
    lg: "sm:max-w-lg",
    xl: "sm:max-w-xl",
    "2xl": "sm:max-w-2xl"
  }[maxWidth];
  return /* @__PURE__ */ jsx(Transition, { show, leave: "duration-200", children: /* @__PURE__ */ jsxs(
    Dialog,
    {
      as: "div",
      id: "modal",
      className: "fixed inset-0 z-50 flex transform items-center justify-center overflow-y-auto px-4 transition-all",
      onClose: close,
      children: [
        /* @__PURE__ */ jsx(
          TransitionChild,
          {
            enter: "ease-out duration-300",
            enterFrom: "opacity-0",
            enterTo: "opacity-100",
            leave: "ease-in duration-200",
            leaveFrom: "opacity-100",
            leaveTo: "opacity-0",
            children: /* @__PURE__ */ jsx("div", { className: "fixed inset-0 bg-gray-500/75" })
          }
        ),
        /* @__PURE__ */ jsx(
          TransitionChild,
          {
            enter: "ease-out duration-300",
            enterFrom: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95",
            enterTo: "opacity-100 translate-y-0 sm:scale-100",
            leave: "ease-in duration-200",
            leaveFrom: "opacity-100 translate-y-0 sm:scale-100",
            leaveTo: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95",
            children: /* @__PURE__ */ jsx(
              DialogPanel,
              {
                className: `relative transform overflow-hidden rounded-lg bg-white shadow-xl transition-all w-full ${maxWidthClass}`,
                children
              }
            )
          }
        )
      ]
    }
  ) });
}
function ReviewCard({ review }) {
  var _a;
  const { imageTypes } = usePage().props;
  const [selectedImage, setSelectedImage] = useState(null);
  const groupedImages = (_a = review.images) == null ? void 0 : _a.reduce((acc, image) => {
    if (!acc[image.pivot.type]) {
      acc[image.pivot.type] = [];
    }
    acc[image.pivot.type].push(image);
    return acc;
  }, {});
  const averageRating = ((parseFloat(review.appearance_rating) + parseFloat(review.texture_rating) + parseFloat(review.flavor_rating)) / 3).toFixed(1);
  return /* @__PURE__ */ jsxs("div", { className: "bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-200", children: [
    /* @__PURE__ */ jsxs("div", { className: "flex items-center justify-between mb-6 border-b border-gray-100 pb-4", children: [
      /* @__PURE__ */ jsx("div", { className: "flex items-center", children: /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("p", { className: "font-semibold text-gray-900", children: review.user.name }),
        /* @__PURE__ */ jsxs("p", { className: "text-sm text-gray-500 mt-1", children: [
          "Purchased at ",
          review.purchase_location || "Unknown"
        ] })
      ] }) }),
      /* @__PURE__ */ jsxs("div", { className: "flex items-center bg-gray-50 px-4 py-2 rounded-lg", children: [
        /* @__PURE__ */ jsx("span", { className: "text-3xl font-bold text-gray-900 mr-2", children: averageRating }),
        /* @__PURE__ */ jsx("span", { className: "text-2xl text-yellow-400", children: "★" })
      ] })
    ] }),
    /* @__PURE__ */ jsx("div", { className: "mb-6", children: /* @__PURE__ */ jsx("p", { className: "text-gray-700 text-lg leading-relaxed", children: review.review }) }),
    /* @__PURE__ */ jsxs("div", { className: "grid grid-cols-3 gap-4 mb-8 bg-gray-50 rounded-lg p-4", children: [
      /* @__PURE__ */ jsxs("div", { className: "flex items-center space-x-2", children: [
        /* @__PURE__ */ jsx("span", { className: "text-yellow-400 text-lg", children: "★" }),
        /* @__PURE__ */ jsxs("div", { children: [
          /* @__PURE__ */ jsx("p", { className: "text-sm font-medium text-gray-900", children: parseFloat(review.appearance_rating).toFixed(1) }),
          /* @__PURE__ */ jsx("p", { className: "text-xs text-gray-500", children: "Appearance" })
        ] })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "flex items-center space-x-2", children: [
        /* @__PURE__ */ jsx("span", { className: "text-yellow-400 text-lg", children: "★" }),
        /* @__PURE__ */ jsxs("div", { children: [
          /* @__PURE__ */ jsx("p", { className: "text-sm font-medium text-gray-900", children: parseFloat(review.texture_rating).toFixed(1) }),
          /* @__PURE__ */ jsx("p", { className: "text-xs text-gray-500", children: "Texture" })
        ] })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "flex items-center space-x-2", children: [
        /* @__PURE__ */ jsx("span", { className: "text-yellow-400 text-lg", children: "★" }),
        /* @__PURE__ */ jsxs("div", { children: [
          /* @__PURE__ */ jsx("p", { className: "text-sm font-medium text-gray-900", children: parseFloat(review.flavor_rating).toFixed(1) }),
          /* @__PURE__ */ jsx("p", { className: "text-xs text-gray-500", children: "Flavor" })
        ] })
      ] })
    ] }),
    review.images && review.images.length > 0 && /* @__PURE__ */ jsx("div", { className: "space-y-6", children: Object.entries(groupedImages).map(([type, images]) => /* @__PURE__ */ jsxs("div", { children: [
      /* @__PURE__ */ jsx("h4", { className: "text-sm font-medium text-gray-900 mb-3", children: imageTypes[type] }),
      /* @__PURE__ */ jsx("div", { className: "grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4", children: images.map((image) => /* @__PURE__ */ jsxs(
        "div",
        {
          className: "relative aspect-square rounded-lg overflow-hidden cursor-pointer group",
          onClick: () => setSelectedImage(image),
          children: [
            /* @__PURE__ */ jsx(
              "img",
              {
                src: getImageUrl(image),
                alt: `${imageTypes[type]} image`,
                className: "h-full w-full object-cover transition-transform duration-200 group-hover:scale-105"
              }
            ),
            /* @__PURE__ */ jsx("div", { className: "absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity duration-200" })
          ]
        },
        image.id
      )) })
    ] }, type)) }),
    /* @__PURE__ */ jsx(Modal, { show: !!selectedImage, onClose: () => setSelectedImage(null), children: selectedImage && /* @__PURE__ */ jsxs("div", { className: "relative", children: [
      /* @__PURE__ */ jsx("div", { className: "absolute top-4 left-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm", children: imageTypes[selectedImage.pivot.type] }),
      /* @__PURE__ */ jsx(
        "button",
        {
          onClick: () => setSelectedImage(null),
          className: "absolute top-4 right-4 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition-colors",
          children: /* @__PURE__ */ jsx(XMarkIcon, { className: "h-6 w-6" })
        }
      ),
      /* @__PURE__ */ jsx(
        "img",
        {
          src: getImageUrl(selectedImage),
          alt: `${imageTypes[selectedImage.pivot.type]} image`,
          className: "max-w-full max-h-[80vh] object-contain"
        }
      )
    ] }) })
  ] });
}
function ReviewList({ reviews }) {
  return /* @__PURE__ */ jsx("div", { className: "space-y-6", children: reviews.map((review) => /* @__PURE__ */ jsx("div", { children: /* @__PURE__ */ jsx(ReviewCard, { review }) }, review.id)) });
}
function ReviewForm({ pizzaId, onSuccess, initialData }) {
  const { imageTypes } = usePage().props;
  const fileInputRef = useRef(null);
  const [previews, setPreviews] = useState([]);
  const { data, setData, post, processing, errors, reset } = useForm({
    appearance_rating: (initialData == null ? void 0 : initialData.appearance_rating) ?? 0,
    texture_rating: (initialData == null ? void 0 : initialData.texture_rating) ?? 0,
    flavor_rating: (initialData == null ? void 0 : initialData.flavor_rating) ?? 0,
    review: (initialData == null ? void 0 : initialData.review) ?? "",
    purchase_location: (initialData == null ? void 0 : initialData.purchase_location) ?? "",
    images: [],
    remove_images: []
  });
  const handleSubmit = (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append("appearance_rating", data.appearance_rating);
    formData.append("texture_rating", data.texture_rating);
    formData.append("flavor_rating", data.flavor_rating);
    formData.append("review", data.review);
    formData.append("purchase_location", data.purchase_location);
    data.images.forEach((image, index) => {
      formData.append(`images[${index}][file]`, image.file);
      formData.append(`images[${index}][type]`, image.type);
    });
    if (data.remove_images.length > 0) {
      data.remove_images.forEach((id) => {
        formData.append("remove_images[]", id);
      });
    }
    post(`/pizzas/${pizzaId}/reviews`, {
      data: formData,
      forceFormData: true,
      onSuccess: () => {
        reset();
        setPreviews([]);
        if (onSuccess) onSuccess();
      }
    });
  };
  const handleImageChange = (e) => {
    const files = Array.from(e.target.files);
    const newImages = files.map((file) => ({
      file,
      type: "other"
      // Default type
    }));
    setData("images", [...data.images, ...newImages]);
    files.forEach((file) => {
      const reader = new FileReader();
      reader.onloadend = () => {
        setPreviews((prev) => [...prev, { file, preview: reader.result, type: "other" }]);
      };
      reader.readAsDataURL(file);
    });
  };
  const removeImage = (index) => {
    const newImages = [...data.images];
    newImages.splice(index, 1);
    setData("images", newImages);
    const newPreviews = [...previews];
    newPreviews.splice(index, 1);
    setPreviews(newPreviews);
  };
  const updateImageType = (index, type) => {
    const newImages = [...data.images];
    newImages[index] = { ...newImages[index], type };
    setData("images", newImages);
    const newPreviews = [...previews];
    newPreviews[index] = { ...newPreviews[index], type };
    setPreviews(newPreviews);
  };
  return /* @__PURE__ */ jsxs("form", { onSubmit: handleSubmit, className: "bg-white rounded-lg shadow p-6", children: [
    /* @__PURE__ */ jsx("h3", { className: "text-lg font-semibold mb-4", children: "Write a Review" }),
    /* @__PURE__ */ jsxs("div", { className: "space-y-4 mb-4", children: [
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("label", { className: "block text-sm font-medium text-gray-700 mb-1", children: "Appearance Rating" }),
        /* @__PURE__ */ jsx("div", { className: "flex space-x-1", children: [1, 2, 3, 4, 5].map((rating) => /* @__PURE__ */ jsx(
          "button",
          {
            type: "button",
            onClick: () => setData("appearance_rating", rating),
            className: "focus:outline-none",
            children: rating <= data.appearance_rating ? /* @__PURE__ */ jsx(StarFilledIcon, { className: "w-8 h-8 text-yellow-400" }) : /* @__PURE__ */ jsx(StarOutlineIcon, { className: "w-8 h-8 text-gray-300 hover:text-yellow-400" })
          },
          rating
        )) })
      ] }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("label", { className: "block text-sm font-medium text-gray-700 mb-1", children: "Texture Rating" }),
        /* @__PURE__ */ jsx("div", { className: "flex space-x-1", children: [1, 2, 3, 4, 5].map((rating) => /* @__PURE__ */ jsx(
          "button",
          {
            type: "button",
            onClick: () => setData("texture_rating", rating),
            className: "focus:outline-none",
            children: rating <= data.texture_rating ? /* @__PURE__ */ jsx(StarFilledIcon, { className: "w-8 h-8 text-yellow-400" }) : /* @__PURE__ */ jsx(StarOutlineIcon, { className: "w-8 h-8 text-gray-300 hover:text-yellow-400" })
          },
          rating
        )) })
      ] }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx("label", { className: "block text-sm font-medium text-gray-700 mb-1", children: "Flavor Rating" }),
        /* @__PURE__ */ jsx("div", { className: "flex space-x-1", children: [1, 2, 3, 4, 5].map((rating) => /* @__PURE__ */ jsx(
          "button",
          {
            type: "button",
            onClick: () => setData("flavor_rating", rating),
            className: "focus:outline-none",
            children: rating <= data.flavor_rating ? /* @__PURE__ */ jsx(StarFilledIcon, { className: "w-8 h-8 text-yellow-400" }) : /* @__PURE__ */ jsx(StarOutlineIcon, { className: "w-8 h-8 text-gray-300 hover:text-yellow-400" })
          },
          rating
        )) })
      ] })
    ] }),
    /* @__PURE__ */ jsxs("div", { className: "mb-4", children: [
      /* @__PURE__ */ jsx("label", { className: "block text-sm font-medium text-gray-700", children: "Review" }),
      /* @__PURE__ */ jsx(
        "textarea",
        {
          value: data.review,
          onChange: (e) => setData("review", e.target.value),
          rows: 4,
          className: "mt-1 block w-full rounded-md border-gray-300 shadow-sm",
          placeholder: "What did you think about this pizza?"
        }
      ),
      errors.review && /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-red-600", children: errors.review })
    ] }),
    /* @__PURE__ */ jsxs("div", { className: "mb-4", children: [
      /* @__PURE__ */ jsx("label", { className: "block text-sm font-medium text-gray-700", children: "Purchase Location" }),
      /* @__PURE__ */ jsx(
        "input",
        {
          type: "text",
          value: data.purchase_location,
          onChange: (e) => setData("purchase_location", e.target.value),
          className: "mt-1 block w-full rounded-md border-gray-300 shadow-sm",
          placeholder: "Where did you buy this pizza?"
        }
      ),
      errors.purchase_location && /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-red-600", children: errors.purchase_location })
    ] }),
    /* @__PURE__ */ jsxs("div", { className: "mb-4", children: [
      /* @__PURE__ */ jsx("label", { className: "block text-sm font-medium text-gray-700", children: "Images" }),
      /* @__PURE__ */ jsx(
        "input",
        {
          type: "file",
          ref: fileInputRef,
          onChange: handleImageChange,
          className: "hidden",
          multiple: true,
          accept: "image/*"
        }
      ),
      /* @__PURE__ */ jsx(
        "button",
        {
          type: "button",
          onClick: () => {
            var _a;
            return (_a = fileInputRef.current) == null ? void 0 : _a.click();
          },
          className: "mt-1 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50",
          children: "Add Images"
        }
      ),
      errors.images && /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-red-600", children: errors.images }),
      previews.length > 0 && /* @__PURE__ */ jsx("div", { className: "mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4", children: previews.map((preview, index) => /* @__PURE__ */ jsxs("div", { className: "relative bg-gray-50 p-4 rounded-lg", children: [
        /* @__PURE__ */ jsx(
          "img",
          {
            src: preview.preview,
            alt: `Preview ${index + 1}`,
            className: "h-32 w-full object-cover rounded-lg mb-2"
          }
        ),
        /* @__PURE__ */ jsx(
          "select",
          {
            value: preview.type,
            onChange: (e) => updateImageType(index, e.target.value),
            className: "mt-2 block w-full rounded-md border-gray-300 shadow-sm text-sm",
            children: Object.entries(imageTypes).map(([value, label]) => /* @__PURE__ */ jsx("option", { value, children: label }, value))
          }
        ),
        /* @__PURE__ */ jsx(
          "button",
          {
            type: "button",
            onClick: () => removeImage(index),
            className: "absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600",
            children: /* @__PURE__ */ jsx(XMarkIcon, { className: "h-4 w-4" })
          }
        )
      ] }, index)) })
    ] }),
    /* @__PURE__ */ jsx("div", { className: "flex justify-end", children: /* @__PURE__ */ jsx(
      "button",
      {
        type: "submit",
        disabled: processing,
        className: "inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50",
        children: processing ? "Submitting..." : "Submit Review"
      }
    ) })
  ] });
}
function NutritionFact({ nutritionFact }) {
  if (!nutritionFact) {
    return /* @__PURE__ */ jsx("div", { children: /* @__PURE__ */ jsx("p", { children: "No nutrition facts available" }) });
  }
  const calculateDailyValue = (value, nutrient) => {
    const valueNumber = parseFloat(value.replace(/[mgc]/g, ""));
    if (isNaN(valueNumber) || valueNumber == 0) {
      return "0";
    }
    const dv = {
      "TOTAL_FAT": 78,
      "SATURATED_FAT": 20,
      "TRANS_FAT": 0,
      "CHOLESTEROL": 300,
      "SODIUM": 2300,
      "TOTAL_CARBOHYDRATE": 275,
      "DIETARY_FIBER": 28,
      "ADDED_SUGARS": 50,
      "PROTEIN": 50,
      "VITAMIN_D": 20,
      "CALCIUM": 1300,
      "IRON": 18,
      "POTASSIUM": 4700
    };
    return Math.round(valueNumber / dv[nutrient] * 100);
  };
  return /* @__PURE__ */ jsxs("div", { className: "w-[300px] border p-4 max-w-xs mx-auto", children: [
    /* @__PURE__ */ jsx("h2", { className: "text-xl font-bold border-b pb-1 mb-2", children: "Nutrition Facts" }),
    nutritionFact.serving_per_container && /* @__PURE__ */ jsx("p", { className: "text-sm", children: nutritionFact.serving_per_container }),
    nutritionFact.serving_size && /* @__PURE__ */ jsxs("p", { className: "text-sm font-semibold", children: [
      /* @__PURE__ */ jsx("strong", { children: "Serving size" }),
      " ",
      nutritionFact.serving_size
    ] }),
    /* @__PURE__ */ jsx("hr", { className: "my-2" }),
    nutritionFact.calories && /* @__PURE__ */ jsxs(Fragment, { children: [
      /* @__PURE__ */ jsx("div", { children: "Amount Per Serving" }),
      /* @__PURE__ */ jsxs("p", { className: "text-2xl font-bold", children: [
        /* @__PURE__ */ jsx("strong", { children: "Calories" }),
        " ",
        /* @__PURE__ */ jsx("span", { className: "float-right", children: nutritionFact.calories })
      ] })
    ] }),
    /* @__PURE__ */ jsxs("div", { className: "border-t-4 border-gray-800 text-sm", children: [
      /* @__PURE__ */ jsx("p", { className: "font-semibold text-right", children: /* @__PURE__ */ jsx("strong", { children: "% Daily Value*" }) }),
      nutritionFact.total_fat && /* @__PURE__ */ jsxs("p", { children: [
        /* @__PURE__ */ jsx("strong", { children: "Total Fat" }),
        " ",
        nutritionFact.total_fat,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.total_fat, "TOTAL_FAT"),
          "%"
        ] })
      ] }),
      nutritionFact.saturated_fat && /* @__PURE__ */ jsxs("p", { className: "indent ml-4", children: [
        "Saturated Fat ",
        nutritionFact.saturated_fat,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.saturated_fat, "SATURATED_FAT"),
          "%"
        ] })
      ] }),
      nutritionFact.trans_fat && /* @__PURE__ */ jsxs("p", { className: "indent ml-4", children: [
        "Trans Fat ",
        nutritionFact.trans_fat,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.trans_fat, "TRANS_FAT"),
          "%"
        ] })
      ] }),
      nutritionFact.cholesterol && /* @__PURE__ */ jsxs("p", { children: [
        /* @__PURE__ */ jsx("strong", { children: "Cholesterol" }),
        " ",
        nutritionFact.cholesterol,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.cholesterol, "CHOLESTEROL"),
          "%"
        ] })
      ] }),
      nutritionFact.sodium && /* @__PURE__ */ jsxs("p", { children: [
        /* @__PURE__ */ jsx("strong", { children: "Sodium" }),
        " ",
        nutritionFact.sodium,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.sodium, "SODIUM"),
          "%"
        ] })
      ] }),
      nutritionFact.total_carbohydrate && /* @__PURE__ */ jsxs("p", { children: [
        /* @__PURE__ */ jsx("strong", { children: "Total Carbohydrate" }),
        " ",
        nutritionFact.total_carbohydrate,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.total_carbohydrate, "TOTAL_CARBOHYDRATE"),
          "%"
        ] })
      ] }),
      nutritionFact.dietary_fiber && /* @__PURE__ */ jsxs("p", { className: "indent ml-4", children: [
        "Dietary Fiber ",
        nutritionFact.dietary_fiber,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.dietary_fiber, "DIETARY_FIBER"),
          "%"
        ] })
      ] }),
      nutritionFact.total_sugars && /* @__PURE__ */ jsxs("p", { className: "indent ml-4", children: [
        "Sugars ",
        nutritionFact.total_sugars
      ] }),
      nutritionFact.added_sugars && /* @__PURE__ */ jsxs("p", { className: "indent ml-4", children: [
        "Added Sugars ",
        nutritionFact.added_sugars,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.added_sugars, "ADDED_SUGARS"),
          "%"
        ] })
      ] }),
      nutritionFact.protein && /* @__PURE__ */ jsxs("p", { children: [
        /* @__PURE__ */ jsx("strong", { children: "Protein" }),
        " ",
        nutritionFact.protein,
        " ",
        /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
          calculateDailyValue(nutritionFact.protein, "PROTEIN"),
          "%"
        ] })
      ] })
    ] }),
    /* @__PURE__ */ jsx("hr", { className: "my-2" }),
    nutritionFact.vitamin_d && /* @__PURE__ */ jsxs("p", { className: "text-sm", children: [
      "Vitamin D ",
      nutritionFact.vitamin_d,
      " ",
      /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
        calculateDailyValue(nutritionFact.vitamin_d, "VITAMIN_D"),
        "%"
      ] })
    ] }),
    nutritionFact.potassium && /* @__PURE__ */ jsxs("p", { className: "text-sm", children: [
      "Potassium ",
      nutritionFact.potassium,
      " ",
      /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
        calculateDailyValue(nutritionFact.potassium, "POTASSIUM"),
        "%"
      ] })
    ] }),
    nutritionFact.iron && /* @__PURE__ */ jsxs("p", { className: "text-sm", children: [
      "Iron ",
      nutritionFact.iron,
      " ",
      /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
        calculateDailyValue(nutritionFact.iron, "IRON"),
        "%"
      ] })
    ] }),
    nutritionFact.calcium && /* @__PURE__ */ jsxs("p", { className: "text-sm", children: [
      "Calcium ",
      nutritionFact.calcium,
      " ",
      /* @__PURE__ */ jsxs("span", { className: "float-right", children: [
        calculateDailyValue(nutritionFact.calcium, "CALCIUM"),
        "%"
      ] })
    ] }),
    /* @__PURE__ */ jsx("p", { className: "border-t border-gray-800 footnote text-xs mt-2", children: "* The % Daily Value (DV) tells you how much a nutrient in a serving of food contributes to a daily diet. 2,000 calories a day is used for general nutrition advice." })
  ] });
}
function PizzaShow({ pizza, meta, auth }) {
  var _a, _b, _c;
  const [isIngredientsOpen, setIngredientsOpen] = useState(false);
  const [isNutritionOpen, setNutritionOpen] = useState(false);
  const [isReviewModalOpen, setReviewModalOpen] = useState(false);
  const toggleAccordion = (setOpen) => {
    setOpen((prevState) => !prevState);
  };
  const mainImage = ((_a = pizza == null ? void 0 : pizza.images) == null ? void 0 : _a.find((image) => image.pivot.type === "main")) ?? null;
  return /* @__PURE__ */ jsxs(MainLayout, { meta, auth, children: [
    /* @__PURE__ */ jsx(Modal, { show: isReviewModalOpen, onClose: () => setReviewModalOpen(false), children: /* @__PURE__ */ jsxs("div", { className: "p-6", children: [
      /* @__PURE__ */ jsx("h3", { className: "text-lg font-semibold mb-4", children: "Write a Review" }),
      /* @__PURE__ */ jsx(
        ReviewForm,
        {
          pizzaId: pizza.id,
          onSuccess: () => setReviewModalOpen(false)
        }
      )
    ] }) }),
    /* @__PURE__ */ jsx(SchemaMarkup, { type: "Pizza", data: pizza }),
    /* @__PURE__ */ jsxs("div", { className: "max-w-7xl mx-auto px-4 sm:px-6 lg:px-8", children: [
      /* @__PURE__ */ jsxs("div", { className: "grid grid-cols-1 md:grid-cols-12 gap-8", children: [
        /* @__PURE__ */ jsx("div", { className: "md:col-span-5", children: /* @__PURE__ */ jsx("div", { className: "relative aspect-square rounded-lg overflow-hidden", children: /* @__PURE__ */ jsx(
          "img",
          {
            className: "absolute inset-0 w-full h-full object-cover",
            src: mainImage ? getImageUrl(mainImage) : "/storage/assets/pizza_placeholder.png",
            alt: pizza.name
          }
        ) }) }),
        /* @__PURE__ */ jsx("div", { className: "md:col-span-7", children: /* @__PURE__ */ jsxs("div", { className: "bg-white rounded-lg shadow-sm p-6", children: [
          /* @__PURE__ */ jsx("h1", { className: "text-3xl font-bold text-gray-900 mb-2", children: pizza.name }),
          /* @__PURE__ */ jsxs("div", { className: "text-sm text-gray-600 mb-4", children: [
            /* @__PURE__ */ jsxs(
              Link,
              {
                href: `/brands/${pizza.brand.slug}`,
                className: "text-indigo-700 hover:underline text-lg text-bold",
                children: [
                  "By ",
                  pizza.brand.name
                ]
              }
            ),
            (pizza == null ? void 0 : pizza.style) && /* @__PURE__ */ jsxs(Fragment, { children: [
              /* @__PURE__ */ jsx("span", { className: "mx-2", children: "•" }),
              /* @__PURE__ */ jsx(
                Link,
                {
                  href: `/styles/${(_b = pizza == null ? void 0 : pizza.style) == null ? void 0 : _b.slug}`,
                  className: "hover:text-indigo-600",
                  children: (_c = pizza == null ? void 0 : pizza.style) == null ? void 0 : _c.name
                }
              )
            ] })
          ] }),
          /* @__PURE__ */ jsxs("div", { className: "flex items-center mb-4", children: [
            /* @__PURE__ */ jsxs("div", { className: "flex items-center bg-yellow-50 px-3 py-1 rounded-lg", children: [
              /* @__PURE__ */ jsx("span", { className: "text-yellow-400 text-xl mr-1", children: "★" }),
              /* @__PURE__ */ jsx("span", { className: "font-semibold text-lg", children: pizza.average_rating ? pizza.average_rating.toFixed(1) : "No ratings" })
            ] }),
            /* @__PURE__ */ jsx("div", { className: "ml-4 text-gray-600", children: /* @__PURE__ */ jsxs("span", { children: [
              pizza.total_reviews,
              " ",
              pizza.total_reviews === 1 ? "Review" : "Reviews"
            ] }) })
          ] }),
          /* @__PURE__ */ jsx("p", { className: "text-gray-700 mb-8", children: pizza == null ? void 0 : pizza.description }),
          /* @__PURE__ */ jsx("div", { className: "bg-gray-50 p-4 rounded-lg mb-8", children: /* @__PURE__ */ jsx("p", { className: "text-sm text-gray-600 italic", children: "Product information or packaging displayed may not be current or complete. Always refer to the physical product for the most accurate information and warnings." }) }),
          /* @__PURE__ */ jsxs("div", { className: "border-t border-gray-200 py-4", children: [
            /* @__PURE__ */ jsxs(
              "button",
              {
                className: "w-full flex items-center justify-between text-left",
                onClick: () => toggleAccordion(setIngredientsOpen),
                children: [
                  /* @__PURE__ */ jsx("span", { className: "text-lg font-semibold", children: "Ingredients" }),
                  isIngredientsOpen ? /* @__PURE__ */ jsx(MinusIcon, {}) : /* @__PURE__ */ jsx(PlusIcon, {})
                ]
              }
            ),
            /* @__PURE__ */ jsx(
              "div",
              {
                className: "mt-2 transition-all duration-200 ease-in-out overflow-hidden",
                style: { maxHeight: isIngredientsOpen ? "1000px" : "0px" },
                children: /* @__PURE__ */ jsx("p", { className: "text-gray-600", children: pizza.ingredients || "No ingredients available" })
              }
            )
          ] }),
          /* @__PURE__ */ jsxs("div", { className: "border-t border-gray-200 py-4", children: [
            /* @__PURE__ */ jsxs(
              "button",
              {
                className: "w-full flex items-center justify-between text-left",
                onClick: () => toggleAccordion(setNutritionOpen),
                children: [
                  /* @__PURE__ */ jsx("span", { className: "text-lg font-semibold", children: "Nutritional Info" }),
                  isNutritionOpen ? /* @__PURE__ */ jsx(MinusIcon, {}) : /* @__PURE__ */ jsx(PlusIcon, {})
                ]
              }
            ),
            /* @__PURE__ */ jsx(
              "div",
              {
                className: "mt-2 transition-all duration-200 ease-in-out overflow-hidden",
                style: { maxHeight: isNutritionOpen ? "1000px" : "0px" },
                children: /* @__PURE__ */ jsx(NutritionFact, { nutritionFact: pizza.nutrition_fact })
              }
            )
          ] })
        ] }) })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-12", children: [
        /* @__PURE__ */ jsx("div", { className: "border-b border-gray-200 mb-8", children: /* @__PURE__ */ jsx("h2", { className: "text-2xl font-bold pb-4", children: "Reviews" }) }),
        pizza.total_reviews > 0 && /* @__PURE__ */ jsx("div", { className: "bg-white rounded-lg shadow-sm p-6 mb-8", children: /* @__PURE__ */ jsxs("div", { className: "grid grid-cols-1 md:grid-cols-2 gap-6", children: [
          /* @__PURE__ */ jsx("div", { className: "flex items-center justify-center", children: /* @__PURE__ */ jsxs("div", { className: "text-center", children: [
            /* @__PURE__ */ jsx("div", { className: "text-5xl font-bold text-gray-900 mb-2", children: pizza.average_rating.toFixed(1) }),
            /* @__PURE__ */ jsx("div", { className: "text-yellow-400 text-2xl mb-1", children: "★★★★★" }),
            /* @__PURE__ */ jsxs("div", { className: "text-gray-600", children: [
              pizza.total_reviews,
              " ",
              pizza.total_reviews === 1 ? "Review" : "Reviews"
            ] })
          ] }) }),
          /* @__PURE__ */ jsx("div", { children: /* @__PURE__ */ jsx("div", { className: "space-y-2", children: [5, 4, 3, 2, 1].map((rating) => {
            var _a2;
            const count = ((_a2 = pizza.rating_breakdown) == null ? void 0 : _a2[rating]) || 0;
            const percentage = count / pizza.total_reviews * 100 || 0;
            return /* @__PURE__ */ jsxs("div", { className: "flex items-center", children: [
              /* @__PURE__ */ jsxs("div", { className: "w-12 text-sm text-gray-600", children: [
                rating,
                " stars"
              ] }),
              /* @__PURE__ */ jsx("div", { className: "flex-1 mx-4 h-4 bg-gray-100 rounded-full overflow-hidden", children: /* @__PURE__ */ jsx(
                "div",
                {
                  className: "h-full bg-yellow-400 rounded-full",
                  style: { width: `${percentage}%` }
                }
              ) }),
              /* @__PURE__ */ jsx("div", { className: "w-12 text-sm text-gray-600", children: count })
            ] }, rating);
          }) }) })
        ] }) }),
        auth.user ? /* @__PURE__ */ jsx(Fragment, { children: !pizza.hasUserReviewed ? /* @__PURE__ */ jsx("div", { className: "mb-8", children: /* @__PURE__ */ jsx(
          "button",
          {
            onClick: () => setReviewModalOpen(true),
            className: "bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors",
            children: "Write a Review"
          }
        ) }) : /* @__PURE__ */ jsx("div", { className: "mb-8", children: /* @__PURE__ */ jsx("p", { className: "text-gray-600", children: "You have already reviewed this pizza." }) }) }) : /* @__PURE__ */ jsx("div", { className: "bg-gray-50 rounded-lg p-6 mb-8 text-center", children: /* @__PURE__ */ jsxs("p", { className: "text-gray-600", children: [
          "Please ",
          /* @__PURE__ */ jsx(
            Link,
            {
              href: `/login`,
              className: "text-indigo-600 hover:text-indigo-800",
              children: "login"
            }
          ),
          " to write a review"
        ] }) }),
        pizza.reviews && pizza.reviews.length > 0 ? /* @__PURE__ */ jsx(ReviewList, { reviews: pizza.reviews }) : /* @__PURE__ */ jsx("p", { className: "text-gray-600 text-center", children: "No reviews yet. Be the first to review this pizza!" })
      ] })
    ] })
  ] });
}
const __vite_glob_0_14 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: PizzaShow
}, Symbol.toStringTag, { value: "Module" }));
function TopRated({ pizzas, meta, auth }) {
  return /* @__PURE__ */ jsxs(MainLayout, { meta, auth, children: [
    /* @__PURE__ */ jsx("h1", { className: "text-2xl font-bold mb-4", children: "Top Rated Frozen Pizzas In The World" }),
    /* @__PURE__ */ jsx("div", { className: "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6", children: pizzas.map((pizza) => /* @__PURE__ */ jsx(PizzaListItem, { pizza }, pizza.id)) })
  ] });
}
const __vite_glob_0_15 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: TopRated
}, Symbol.toStringTag, { value: "Module" }));
function Privacy({ auth }) {
  return /* @__PURE__ */ jsx(MainLayout, { auth, children: /* @__PURE__ */ jsxs("div", { className: "max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md", children: [
    /* @__PURE__ */ jsx("h1", { className: "text-3xl font-bold mb-6", children: "Privacy Policy" }),
    /* @__PURE__ */ jsxs("section", { className: "mb-8", children: [
      /* @__PURE__ */ jsx("h2", { className: "text-2xl font-semibold mb-4", children: "Information We Collect" }),
      /* @__PURE__ */ jsx("p", { className: "mb-4", children: "We collect information that you provide directly to us, including:" }),
      /* @__PURE__ */ jsxs("ul", { className: "list-disc ml-6 mb-4", children: [
        /* @__PURE__ */ jsx("li", { children: "Name and contact information" }),
        /* @__PURE__ */ jsx("li", { children: "Order history and preferences" }),
        /* @__PURE__ */ jsx("li", { children: "Delivery addresses" }),
        /* @__PURE__ */ jsx("li", { children: "Payment information" })
      ] })
    ] }),
    /* @__PURE__ */ jsxs("section", { className: "mb-8", children: [
      /* @__PURE__ */ jsx("h2", { className: "text-2xl font-semibold mb-4", children: "How We Use Your Information" }),
      /* @__PURE__ */ jsx("p", { className: "mb-4", children: "We use the information we collect to:" }),
      /* @__PURE__ */ jsxs("ul", { className: "list-disc ml-6 mb-4", children: [
        /* @__PURE__ */ jsx("li", { children: "Process and deliver your orders" }),
        /* @__PURE__ */ jsx("li", { children: "Send you order confirmations and updates" }),
        /* @__PURE__ */ jsx("li", { children: "Improve our services and customer experience" }),
        /* @__PURE__ */ jsx("li", { children: "Communicate with you about promotions and special offers" })
      ] })
    ] }),
    /* @__PURE__ */ jsxs("section", { className: "mb-8", children: [
      /* @__PURE__ */ jsx("h2", { className: "text-2xl font-semibold mb-4", children: "Information Sharing" }),
      /* @__PURE__ */ jsx("p", { className: "mb-4", children: "We do not sell or share your personal information with third parties except as necessary to provide our services (such as with delivery partners or payment processors)." })
    ] }),
    /* @__PURE__ */ jsxs("section", { className: "mb-8", children: [
      /* @__PURE__ */ jsx("h2", { className: "text-2xl font-semibold mb-4", children: "Security" }),
      /* @__PURE__ */ jsx("p", { className: "mb-4", children: "We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction." })
    ] }),
    /* @__PURE__ */ jsxs("section", { children: [
      /* @__PURE__ */ jsx("h2", { className: "text-2xl font-semibold mb-4", children: "Contact Us" }),
      /* @__PURE__ */ jsxs("p", { children: [
        "If you have any questions about our Privacy Policy, please contact us through our",
        " ",
        /* @__PURE__ */ jsx("a", { href: "/contact", className: "text-blue-600 hover:text-blue-800", children: "contact page" }),
        "."
      ] })
    ] })
  ] }) });
}
const __vite_glob_0_16 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: Privacy
}, Symbol.toStringTag, { value: "Module" }));
function DangerButton({
  className = "",
  disabled,
  children,
  ...props
}) {
  return /* @__PURE__ */ jsx(
    "button",
    {
      ...props,
      className: `inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700 ${disabled && "opacity-25"} ` + className,
      disabled,
      children
    }
  );
}
function SecondaryButton({
  type = "button",
  className = "",
  disabled,
  children,
  ...props
}) {
  return /* @__PURE__ */ jsx(
    "button",
    {
      ...props,
      type,
      className: `inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 ${disabled && "opacity-25"} ` + className,
      disabled,
      children
    }
  );
}
function DeleteUserForm({ className = "" }) {
  const [confirmingUserDeletion, setConfirmingUserDeletion] = useState(false);
  const passwordInput = useRef();
  const {
    data,
    setData,
    delete: destroy,
    processing,
    reset,
    errors,
    clearErrors
  } = useForm({
    password: ""
  });
  const confirmUserDeletion = () => {
    setConfirmingUserDeletion(true);
  };
  const deleteUser = (e) => {
    e.preventDefault();
    destroy(route("profile.destroy"), {
      preserveScroll: true,
      onSuccess: () => closeModal(),
      onError: () => passwordInput.current.focus(),
      onFinish: () => reset()
    });
  };
  const closeModal = () => {
    setConfirmingUserDeletion(false);
    clearErrors();
    reset();
  };
  return /* @__PURE__ */ jsxs("section", { className: `space-y-6 ${className}`, children: [
    /* @__PURE__ */ jsxs("header", { children: [
      /* @__PURE__ */ jsx("h2", { className: "text-lg font-medium text-gray-900", children: "Delete Account" }),
      /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-gray-600", children: "Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain." })
    ] }),
    /* @__PURE__ */ jsx(DangerButton, { onClick: confirmUserDeletion, children: "Delete Account" }),
    /* @__PURE__ */ jsx(Modal, { show: confirmingUserDeletion, onClose: closeModal, children: /* @__PURE__ */ jsxs("form", { onSubmit: deleteUser, className: "p-6", children: [
      /* @__PURE__ */ jsx("h2", { className: "text-lg font-medium text-gray-900", children: "Are you sure you want to delete your account?" }),
      /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-gray-600", children: "Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account." }),
      /* @__PURE__ */ jsxs("div", { className: "mt-6", children: [
        /* @__PURE__ */ jsx(
          InputLabel,
          {
            htmlFor: "password",
            value: "Password",
            className: "sr-only"
          }
        ),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "password",
            type: "password",
            name: "password",
            ref: passwordInput,
            value: data.password,
            onChange: (e) => setData("password", e.target.value),
            className: "mt-1 block w-3/4",
            isFocused: true,
            placeholder: "Password"
          }
        ),
        /* @__PURE__ */ jsx(
          InputError,
          {
            message: errors.password,
            className: "mt-2"
          }
        )
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "mt-6 flex justify-end", children: [
        /* @__PURE__ */ jsx(SecondaryButton, { onClick: closeModal, children: "Cancel" }),
        /* @__PURE__ */ jsx(DangerButton, { className: "ms-3", disabled: processing, children: "Delete Account" })
      ] })
    ] }) })
  ] });
}
const __vite_glob_0_18 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: DeleteUserForm
}, Symbol.toStringTag, { value: "Module" }));
function UpdatePasswordForm({ className = "" }) {
  const passwordInput = useRef();
  const currentPasswordInput = useRef();
  const {
    data,
    setData,
    errors,
    put,
    reset,
    processing,
    recentlySuccessful
  } = useForm({
    current_password: "",
    password: "",
    password_confirmation: ""
  });
  const updatePassword = (e) => {
    e.preventDefault();
    put(route("password.update"), {
      preserveScroll: true,
      onSuccess: () => reset(),
      onError: (errors2) => {
        if (errors2.password) {
          reset("password", "password_confirmation");
          passwordInput.current.focus();
        }
        if (errors2.current_password) {
          reset("current_password");
          currentPasswordInput.current.focus();
        }
      }
    });
  };
  return /* @__PURE__ */ jsxs("section", { className, children: [
    /* @__PURE__ */ jsxs("header", { children: [
      /* @__PURE__ */ jsx("h2", { className: "text-lg font-medium text-gray-900", children: "Update Password" }),
      /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-gray-600", children: "Ensure your account is using a long, random password to stay secure." })
    ] }),
    /* @__PURE__ */ jsxs("form", { onSubmit: updatePassword, className: "mt-6 space-y-6", children: [
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx(
          InputLabel,
          {
            htmlFor: "current_password",
            value: "Current Password"
          }
        ),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "current_password",
            ref: currentPasswordInput,
            value: data.current_password,
            onChange: (e) => setData("current_password", e.target.value),
            type: "password",
            className: "mt-1 block w-full",
            autoComplete: "current-password"
          }
        ),
        /* @__PURE__ */ jsx(
          InputError,
          {
            message: errors.current_password,
            className: "mt-2"
          }
        )
      ] }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "password", value: "New Password" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "password",
            ref: passwordInput,
            value: data.password,
            onChange: (e) => setData("password", e.target.value),
            type: "password",
            className: "mt-1 block w-full",
            autoComplete: "new-password"
          }
        ),
        /* @__PURE__ */ jsx(InputError, { message: errors.password, className: "mt-2" })
      ] }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx(
          InputLabel,
          {
            htmlFor: "password_confirmation",
            value: "Confirm Password"
          }
        ),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "password_confirmation",
            value: data.password_confirmation,
            onChange: (e) => setData("password_confirmation", e.target.value),
            type: "password",
            className: "mt-1 block w-full",
            autoComplete: "new-password"
          }
        ),
        /* @__PURE__ */ jsx(
          InputError,
          {
            message: errors.password_confirmation,
            className: "mt-2"
          }
        )
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "flex items-center gap-4", children: [
        /* @__PURE__ */ jsx(PrimaryButton, { disabled: processing, children: "Save" }),
        /* @__PURE__ */ jsx(
          Transition,
          {
            show: recentlySuccessful,
            enter: "transition ease-in-out",
            enterFrom: "opacity-0",
            leave: "transition ease-in-out",
            leaveTo: "opacity-0",
            children: /* @__PURE__ */ jsx("p", { className: "text-sm text-gray-600", children: "Saved." })
          }
        )
      ] })
    ] })
  ] });
}
const __vite_glob_0_19 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: UpdatePasswordForm
}, Symbol.toStringTag, { value: "Module" }));
function UpdateProfileInformation({
  mustVerifyEmail,
  status,
  className = ""
}) {
  const user = usePage().props.auth.user;
  const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
    name: user.name,
    email: user.email
  });
  const submit = (e) => {
    e.preventDefault();
    patch(route("profile.update"));
  };
  return /* @__PURE__ */ jsxs("section", { className, children: [
    /* @__PURE__ */ jsxs("header", { children: [
      /* @__PURE__ */ jsx("h2", { className: "text-lg font-medium text-gray-900", children: "Profile Information" }),
      /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-gray-600", children: "Update your account's profile information and email address." })
    ] }),
    /* @__PURE__ */ jsxs("form", { onSubmit: submit, className: "mt-6 space-y-6", children: [
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "name", value: "Name" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "name",
            className: "mt-1 block w-full",
            value: data.name,
            onChange: (e) => setData("name", e.target.value),
            required: true,
            isFocused: true,
            autoComplete: "name"
          }
        ),
        /* @__PURE__ */ jsx(InputError, { className: "mt-2", message: errors.name })
      ] }),
      /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsx(InputLabel, { htmlFor: "email", value: "Email" }),
        /* @__PURE__ */ jsx(
          TextInput,
          {
            id: "email",
            type: "email",
            className: "mt-1 block w-full",
            value: data.email,
            onChange: (e) => setData("email", e.target.value),
            required: true,
            autoComplete: "username"
          }
        ),
        /* @__PURE__ */ jsx(InputError, { className: "mt-2", message: errors.email })
      ] }),
      mustVerifyEmail && user.email_verified_at === null && /* @__PURE__ */ jsxs("div", { children: [
        /* @__PURE__ */ jsxs("p", { className: "mt-2 text-sm text-gray-800", children: [
          "Your email address is unverified.",
          /* @__PURE__ */ jsx(
            Link,
            {
              href: route("verification.send"),
              method: "post",
              as: "button",
              className: "rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2",
              children: "Click here to re-send the verification email."
            }
          )
        ] }),
        status === "verification-link-sent" && /* @__PURE__ */ jsx("div", { className: "mt-2 text-sm font-medium text-green-600", children: "A new verification link has been sent to your email address." })
      ] }),
      /* @__PURE__ */ jsxs("div", { className: "flex items-center gap-4", children: [
        /* @__PURE__ */ jsx(PrimaryButton, { disabled: processing, children: "Save" }),
        /* @__PURE__ */ jsx(
          Transition,
          {
            show: recentlySuccessful,
            enter: "transition ease-in-out",
            enterFrom: "opacity-0",
            leave: "transition ease-in-out",
            leaveTo: "opacity-0",
            children: /* @__PURE__ */ jsx("p", { className: "text-sm text-gray-600", children: "Saved." })
          }
        )
      ] })
    ] })
  ] });
}
const __vite_glob_0_20 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: UpdateProfileInformation
}, Symbol.toStringTag, { value: "Module" }));
function Edit({ mustVerifyEmail, status }) {
  return /* @__PURE__ */ jsxs(
    AuthenticatedLayout,
    {
      header: /* @__PURE__ */ jsx("h2", { className: "text-xl font-semibold leading-tight text-gray-800", children: "Profile" }),
      children: [
        /* @__PURE__ */ jsx(Head, { title: "Profile" }),
        /* @__PURE__ */ jsx("div", { className: "py-12", children: /* @__PURE__ */ jsxs("div", { className: "mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8", children: [
          /* @__PURE__ */ jsx("div", { className: "bg-white p-4 shadow sm:rounded-lg sm:p-8", children: /* @__PURE__ */ jsx(
            UpdateProfileInformation,
            {
              mustVerifyEmail,
              status,
              className: "max-w-xl"
            }
          ) }),
          /* @__PURE__ */ jsx("div", { className: "bg-white p-4 shadow sm:rounded-lg sm:p-8", children: /* @__PURE__ */ jsx(UpdatePasswordForm, { className: "max-w-xl" }) }),
          /* @__PURE__ */ jsx("div", { className: "bg-white p-4 shadow sm:rounded-lg sm:p-8", children: /* @__PURE__ */ jsx(DeleteUserForm, { className: "max-w-xl" }) })
        ] }) })
      ]
    }
  );
}
const __vite_glob_0_17 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: Edit
}, Symbol.toStringTag, { value: "Module" }));
const isServer = typeof window === "undefined";
if (!isServer) {
  window.axios = axios;
  window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
}
axios.create({
  baseURL: "http://127.0.0.1:8001",
  headers: {
    "X-Requested-With": "XMLHttpRequest"
  }
});
createServer(
  (page) => createInertiaApp({
    page,
    render: ReactDOMServer.renderToString,
    resolve: (name) => {
      const pages = /* @__PURE__ */ Object.assign({ "./Pages/Auth/ConfirmPassword.jsx": __vite_glob_0_0, "./Pages/Auth/DeleteDataInstructions.jsx": __vite_glob_0_1, "./Pages/Auth/ForgotPassword.jsx": __vite_glob_0_2, "./Pages/Auth/Login.jsx": __vite_glob_0_3, "./Pages/Auth/Register.jsx": __vite_glob_0_4, "./Pages/Auth/ResetPassword.jsx": __vite_glob_0_5, "./Pages/Auth/VerifyEmail.jsx": __vite_glob_0_6, "./Pages/Blog/Index.jsx": __vite_glob_0_7, "./Pages/Blog/Show.jsx": __vite_glob_0_8, "./Pages/Brands/Index.jsx": __vite_glob_0_9, "./Pages/Brands/Show.jsx": __vite_glob_0_10, "./Pages/Contact.jsx": __vite_glob_0_11, "./Pages/Dashboard.jsx": __vite_glob_0_12, "./Pages/Pizzas/Index.jsx": __vite_glob_0_13, "./Pages/Pizzas/Show.jsx": __vite_glob_0_14, "./Pages/Pizzas/TopRated.jsx": __vite_glob_0_15, "./Pages/Privacy.jsx": __vite_glob_0_16, "./Pages/Profile/Edit.jsx": __vite_glob_0_17, "./Pages/Profile/Partials/DeleteUserForm.jsx": __vite_glob_0_18, "./Pages/Profile/Partials/UpdatePasswordForm.jsx": __vite_glob_0_19, "./Pages/Profile/Partials/UpdateProfileInformationForm.jsx": __vite_glob_0_20 });
      return pages[`./Pages/${name}.jsx`];
    },
    setup: ({ App, props }) => {
      return React.createElement(App, props);
    }
  })
);
