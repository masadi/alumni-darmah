(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{"/nii":function(t,n,e){"use strict";e.r(n);var r=e("qlm0"),i=e("GUe+"),a=e("SRip"),s=e("OOfG"),c=e("tvh2"),l={components:{VuexyLogo:s.a,BLink:r.a,BButton:i.a,BImg:a.a},data:function(){return{downImg:e("1lUy"),app:c.a.state.appConfig.app}},computed:{imgUrl:function(){return"dark"===c.a.state.appConfig.layout.skin?(this.downImg=e("ZBCI"),this.downImg):this.downImg}}},o=(e("f8Lm"),e("KHd+")),p=Object(o.a)(l,(function(){var t=this,n=t.$createElement,e=t._self._c||n;return e("div",{staticClass:"misc-wrapper"},[e("b-link",{staticClass:"brand-logo"},[e("vuexy-logo"),t._v(" "),e("h2",{staticClass:"brand-text text-primary ml-1"},[t._v("\n        "+t._s(t.app.name)+" Versi "+t._s(t.app.version)+"\n      ")])],1),t._v(" "),e("div",{staticClass:"misc-inner p-2 p-sm-3"},[e("div",{staticClass:"w-100 text-center"},[e("h2",{staticClass:"mb-1"},[t._v("\n          Halaman tidak ditemukan 🕵🏻‍♀️\n        ")]),t._v(" "),e("p",{staticClass:"mb-2"},[t._v("\n          Oops! 😖 Alamat yang diminta tidak ditemukan di aplikasi ini.\n        ")]),t._v(" "),e("b-button",{staticClass:"mb-2 btn-sm-block",attrs:{variant:"primary",to:{path:"/"}}},[t._v("\n          Kembali ke Beranda\n        ")]),t._v(" "),e("b-img",{attrs:{fluid:"",src:t.imgUrl,alt:"Error page"}})],1)])],1)}),[],!1,null,null,null);n.default=p.exports},"1lUy":function(t,n){t.exports="/images/_/_/_/_/alumni-darmah/resources/js/src/assets/images/pages/error.svg"},"7B+K":function(t,n,e){var r=e("QdBx");"string"==typeof r&&(r=[[t.i,r,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(r,i);r.locals&&(t.exports=r.locals)},OOfG:function(t,n,e){"use strict";var r={components:{BImg:e("SRip").a},data:function(){return{sideImg:e("/VGv")}},computed:{imgUrl:function(){return this.sideImg}}},i=e("KHd+"),a=Object(i.a)(r,(function(){var t=this.$createElement;return(this._self._c||t)("b-img",{attrs:{src:this.imgUrl,height:"24",alt:"Logo"}})}),[],!1,null,null,null);n.a=a.exports},QdBx:function(t,n,e){(n=e("JPst")(!1)).push([t.i,".misc-wrapper {\n  display: flex;\n  flex-basis: 100%;\n  min-height: 100vh;\n  width: 100%;\n  align-items: center;\n  justify-content: center;\n}\n.misc-wrapper .misc-inner {\n  position: relative;\n  max-width: 750px;\n}\n.misc-wrapper .brand-logo {\n  display: flex;\n  justify-content: center;\n  position: absolute;\n  top: 2rem;\n}\n[dir] .misc-wrapper .brand-logo {\n  margin: 0;\n}\n[dir=ltr] .misc-wrapper .brand-logo {\n  left: 2rem;\n}\n[dir=rtl] .misc-wrapper .brand-logo {\n  right: 2rem;\n}\n.misc-wrapper .brand-logo .brand-text {\n  font-weight: 600;\n}\n@media (max-height: 625px) {\n[dir] .misc-wrapper .misc-inner {\n    margin-top: 4rem;\n}\n}\n.brand-logo svg {\n  height: 28px;\n  width: 40.95px;\n}",""]),t.exports=n},SRip:function(t,n,e){"use strict";e.d(n,"b",(function(){return b})),e.d(n,"a",(function(){return f}));var r=e("L3ns"),i=e("tC49"),a=e("xjcK"),s=e("pyNs"),c=e("Iyau"),l=e("bAY6"),o=e("ex6f"),p=e("OljW"),u=e("z3V6"),m=e("+nMp");function d(t,n,e){return n in t?Object.defineProperty(t,n,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[n]=e,t}var g='<svg width="%{w}" height="%{h}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %{w} %{h}" preserveAspectRatio="none"><rect width="100%" height="100%" style="fill:%{f};"></rect></svg>',b=Object(u.d)({alt:Object(u.c)(s.t),blank:Object(u.c)(s.g,!1),blankColor:Object(u.c)(s.t,"transparent"),block:Object(u.c)(s.g,!1),center:Object(u.c)(s.g,!1),fluid:Object(u.c)(s.g,!1),fluidGrow:Object(u.c)(s.g,!1),height:Object(u.c)(s.o),left:Object(u.c)(s.g,!1),right:Object(u.c)(s.g,!1),rounded:Object(u.c)(s.i,!1),sizes:Object(u.c)(s.f),src:Object(u.c)(s.t),srcset:Object(u.c)(s.f),thumbnail:Object(u.c)(s.g,!1),width:Object(u.c)(s.o)},a.Q),f=Object(r.c)({name:a.Q,functional:!0,props:b,render:function(t,n){var e,r=n.props,a=n.data,s=r.alt,u=r.src,b=r.block,f=r.fluidGrow,h=r.rounded,v=Object(p.b)(r.width)||null,w=Object(p.b)(r.height)||null,j=null,O=Object(c.b)(r.srcset).filter(l.a).join(","),x=Object(c.b)(r.sizes).filter(l.a).join(",");return r.blank&&(!w&&v?w=v:!v&&w&&(v=w),v||w||(v=1,w=1),u=function(t,n,e){var r=encodeURIComponent(g.replace("%{w}",Object(m.g)(t)).replace("%{h}",Object(m.g)(n)).replace("%{f}",e));return"data:image/svg+xml;charset=UTF-8,".concat(r)}(v,w,r.blankColor||"transparent"),O=null,x=null),r.left?j="float-left":r.right?j="float-right":r.center&&(j="mx-auto",b=!0),t("img",Object(i.a)(a,{attrs:{src:u,alt:s,width:v?Object(m.g)(v):null,height:w?Object(m.g)(w):null,srcset:O||null,sizes:x||null},class:(e={"img-thumbnail":r.thumbnail,"img-fluid":r.fluid||f,"w-100":f,rounded:""===h||!0===h},d(e,"rounded-".concat(h),Object(o.n)(h)&&""!==h),d(e,j,j),d(e,"d-block",b),e)}))}})},ZBCI:function(t,n){t.exports="/images/_/_/_/_/alumni-darmah/resources/js/src/assets/images/pages/error-dark.svg"},f8Lm:function(t,n,e){"use strict";e("7B+K")}}]);