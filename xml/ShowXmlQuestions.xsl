<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<head>
				<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8" />
				<title>Galderak</title>
				<link rel='stylesheet' type='text/css' href='../styles/Style.css' />
			</head>
			<body>
				<h2>Galderak ikusi XML</h2>
				<br/>
				<table border="1">
					<thead>
						<tr>
							<th> EPOSTA </th>
							<th> GALDERA </th>
							<th> ERANTZUNA </th>
							<th colspan="3"> ERANTZUN OKERRAK </th>
							<!--th> ZAILTASUNA </th-->
							<th> GAIA </th>
						</tr>
					</thead>
					<tbody>
						<xsl:for-each select="/assessmentItems/assessmentItem">
							<tr>
								<td>
									<xsl:value-of select="@author"/>
								</td>
								<td>
									<xsl:value-of select="itemBody"/>
								</td>
								<td>
									<xsl:value-of select="correctResponse"/>
								</td>
								<xsl:for-each select="incorrectResponses/value">
									<td>
										<xsl:value-of select="."/>
									</td>
								</xsl:for-each>
								<!--td><xsl:value-of select="@difficulty"/></td-->
								<td>
									<xsl:value-of select="@subject"/>
								</td>
							</tr>
						</xsl:for-each>
					</tbody>
				</table>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>