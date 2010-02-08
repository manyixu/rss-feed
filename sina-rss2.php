<?php

$username=$_GET["id"]; // request any username with '?id='
if ( empty($username) ) {
	$username='1494759712';    // <-- change this to your username!
} else {
	// Make sure username request is alphanumeric
	$username=ereg_replace("[^A-Za-z0-9]", "", $username);
}
$feedURL='http://v.t.sina.com.cn/widget/widget_blog.php?height=500&skin=wd_01&showpic=1&uid='.$username;

$C = new Collection();
$C->url = $feedURL;
$C->startFlag = '<div id="content_all" class="wgtList">';
$C->endFlag   = '<div id="rolldown" class="wgtMain_bot">';
$C->init();
$C->regExp = "|<p class=\"wgtCell_txt\">(.*)</p>(.*)<a href=\"(.*)\" title=\"\" target=\"_blank\" class=\"link_d\">|Uis";

$C->parse();

header("Content-type:application/xml");

?>
<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0">
	<channel>
		<title>rssfeed</title>
		<link>rssfeed</link>
		<description>rssfeed</description>
		<language>zh-cn</language> 
<?php 
for ($i=0;$i<=9;$i++) { 
	$tguid=$C->result[$i][3];
	$tcon=strip_tags($C->result[$i][1]);
if (!empty($tcon)) {
?>
     <item>
		<title><?php echo $tcon; ?></title>
		<description><![CDATA[<?php echo $tcon; ?>]]></description>
		<pubDate>2010-02-06T08:4<?php echo 9-$i; ?>:04Z</pubDate>
		<guid><?php echo $tguid; ?></guid>
		<link><?php echo $tguid; ?></link>
	</item>
<?php
}

} ?>
	</channel>
</rss>

<?php

class Collection{
//��� ����
var $url;       //��������url��ַ
var $content; //��ȡ��������
var $regExp; //Ҫ��ȡ���ֵ�������ʽ
var $codeFrom; //ԭ�ĵı���
var $codeTo; //��ת���ı���
var $timeout;        //�ȴ���ʱ��

var $startFlag;       //���¿�ʼ�ı�־ Ĭ��Ϊ0       �ڽ�����Ŀʱ��ֻ��$startFlag �� $endFlag֮������ֿ����������
var $endFlag;       //���½����ı�־ Ĭ��Ϊ����ĩβ �ڽ�����Ŀʱ��ֻ��$startFlag �� $endFlag֮������ֿ����������  
var $block;        //$startFlag �� $endFlag֮������ֿ�
//���� ˽��
var $result;       //������

//��ʼ���ռ���
function init(){
       if(empty($url))
       $this->getFile();
       $this->convertEncoding();
}
//��������
function parse(){
       $this->getBlock();
       preg_match_all($this->regExp, $this->block ,$this->result,PREG_SET_ORDER);
       return $this->block;
}
//������
function error($msg){
       echo $msg;
}
//��ȡԶ����ҳ ����ɹ��������ļ������ʧ�ܴ���false
function getFile(){

		$f = new SaeFetchurl();
		$datalines = $f->fetch($this->url);
             if(!$datalines){
        $this->error("can't read the url:".$this->url);
                 return false;
       } else {
        $importdata = $datalines;
        $this->content = $importdata;
	   }
          }
       //��ȡ����Ҫ�����ֿ�
       function getBlock(){
       if(!empty($this->startFlag))
        $this->block = substr($this->content,strpos($this->content,$this->startFlag));
       if(!empty($this->endFlag))
        $this->block = substr($this->block,0,strpos($this->block,$this->endFlag));
       }
       //���ݱ����ת��
       function convertEncoding(){
       if(!empty($this->codeTo))
        $this->codeFrom = mb_detect_encoding($this->content);
       //�������ת����������ִ��ת����
       if(!empty($this->codeTo))
        $this->content = mb_convert_encoding($this->content,$this->codeTo,$this->codeFrom) or $this->error("can't convert Encoding");
       }
}//end of class

?>