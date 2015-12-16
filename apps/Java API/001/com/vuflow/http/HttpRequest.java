package com.vuflow.http;

import com.vuflow.http.forms.FormFactory;

public class HttpRequest {
	
	public String sendLoginDetails(String user_identifier, String user_password)
	{
		try {
			return FormFactory.postForm("api_method=APP&user_identifier=" + user_identifier + "&user_password=" + user_password, "http://api.vuflow.com");
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		return null;
	}

}
