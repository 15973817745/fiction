$(function() {
    $("#file_upload").uploadify({
        'swf' : SCOPE.uploadify_swf,
        'uploader': SCOPE.image_upload,
       'buttonText': "图片上传",  
       'fileTypeDesc':'Image files',
       'fileObjName':'file',
       'fileTypeExts':'*.gir;*.jpg;*.png',
        'onUploadSuccess' : function(file, data, response) {
        	
          	if(response){
          		var obj = JSON.parse(data);
          		$("#upload_org_code_img").attr("src",obj.data);
          		$("#file_upload_image").attr("value",obj.data);
          		$("#upload_org_code_img").show();
          	}
          }
    });
    
    $("#file_cent_upload").uploadify({
        'swf' : SCOPE.uploadify_swf,
        'uploader': SCOPE.image_upload,
       'buttonText': "文件上传",  
       'fileTypeDesc':'All Files',
       'fileObjName':'file',
       'fileTypeExts':'*.txt;*.doc;*.docx;*.ppt;*.pptx;*.pdf',
       'queueSizeLimit'  : 5,//一个队列上传文件数限制  
       'simUploadLimit'  : 5, //一次同步上传的文件数目  
       'removeCompleted' : true, //完成时是否清除队列 默认true    
       'removeTimeout'   : 1,   //完成时清除队列显示秒数,默认3秒    
       'requeueErrors'   : false, //设置上传过程中因为出错导致上传失败的文件是否重新加入队列中上传  
       'successTimeout'  : 30,   //设置文件上传后等待服务器响应的秒数，超出这个时间，将会被认为上传成功，默认为30秒  
       'fileSizeLimit' : '40MB',
        'onUploadSuccess' : function(file, data, response) {
        	
          	if(response){
          		var obj = JSON.parse(data);
          		$("#upload_cent_org_code_img").attr("src",obj.data);
          		$("#file__cent_upload_image").attr("value",obj.data);
          		$("#upload_cent_org_code_img").show();
          	}
          }
    });
  
});