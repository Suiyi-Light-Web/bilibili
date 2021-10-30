# WordPress B站追番/追剧页面模板

### 本项目为 [bilibili](https://github.com/Fog-Forest/bilibili) 的修改版
注意：特殊适配于[Argon主题](https://github.com/solstice23/argon-theme)~

### 使用说明
1. 下载本项目，将 `json` 整个目录扔到你的站点根路径，将 `page-anime.php` 和 `page-movie.php` 文件放到你的主题根路径。

2. 按照注释，修改 `json` 里的 `bilibiliAcconut.php` 文件，填入你的信息。

3. 最后在 WP后台 新建页面时选择相应的模板，创建页面即可。

### 获取信息
#### 1. 获取B站UID
打开[](https://www.bilibili.com/)，登入后进入个人空间，红框处为你的 UID，不要忘记把番剧设置成公开哦~


#### 2. 获取Cookie
登入后进入个人空间，按 **F12** 进入浏览器调试工具，打开 `Network` 再次刷新页面，找到与你 UID 相同的链接并打开，找到 `cookie` 一栏，**为了省事就完全复制**，每个人的 Cookie 都不一样，建议用浏览器的 **无痕模式** 操作，这里用谷歌浏览器演示，如下图：


举例（长度可能不一样）：`_uuid=XXXXXXX-XXXX-XXXX-XXXX-82C16AFEC65E68468infoc; buvid3=8A0CA4AF-XXXX-XXXX-XXXX-8357010EB5F3155827infoc; sid=iwqx36hz; DedeUserID=8142789; DedeUserID__ckMd5=02832b48fef34f47; SESSDATA=fed39455%2C1606203773%2C8731e*51; bili_jct=58ba9ab942399022c6d85195c26f15e3`



### 预览

[https://blog.suiyil.cn/bilibili-bangumi](https://blog.suiyil.cn/bilibili-bangumi)
