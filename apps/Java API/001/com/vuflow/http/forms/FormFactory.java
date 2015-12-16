package com.vuflow.http.forms;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class FormFactory {
	
	public static String postForm(String data, String url) throws Exception
	{
		String rawData = data;
		String type = "application/x-www-form-urlencoded";
		String encodedData = URLEncoder.encode(rawData); 
		URL u = new URL(url);
		HttpURLConnection conn = (HttpURLConnection) u.openConnection();
		conn.setDoOutput(true);
		conn.setRequestMethod("POST");
		conn.setRequestProperty("Content-Type", type);
		conn.setRequestProperty("Content-Length", String.valueOf(encodedData.length()));
		OutputStream os = conn.getOutputStream();
		os.write(encodedData.getBytes());
		BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
		return bufferedReader.readLine();
	}
	
}
