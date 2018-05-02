
function article(title,link,img,date,site,cat,siteImg) {

    this.title = title;
    this.link = link;
    this.img = img;
    this.date = date;
    this.cat = cat;
    this.site = site;
    this.siteImg = siteImg;
    this.validateArticle=function(){
        if(this.img.includes("http:https")) {
        this.img=this.img.slice(5,this.img.length)
        }
        if(this.title.includes("<![CDATA[")){
            this.title=this.title.slice(9,this.title.length)
            this.title=this.title.slice(0,this.title.length-3)
        }
        while(this.title.includes("&quot;"))this.title=this.title.replace("&quot;","\"")
    }
    this.createArticle = function () {

        this.validateArticle();
        var article = $("<article>", {class: "article-container"});
        var footer = $("<div>", {class: "article-footer"});
        var siteImage = $("<img>", {class: "article-site-image", src: this.siteImg});
        var headerDate = $("<div>", {class: "article-date"}).text(this.date);
        var mainImage = $("<img>", {class: "article-img", src: this.img});
        var mainImageLink=$("<a>", { href: this.link,target:"_blank"})
        var mainTitle = $("<a>", {class: "article-title", href: this.link,target:"_blank"}).text(this.title);
        mainImageLink.append(mainImage)
        footer.append(headerDate).append(siteImage);
        article.append(mainImageLink).append(mainTitle).append(footer)//append(main)
        $("container").append(article)
    }
}







//showArticles();





