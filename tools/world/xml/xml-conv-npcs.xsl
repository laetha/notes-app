<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="npc">
    <xsl:copy>
      <xsl:apply-templates select="name"/>
      <gender>
                <xsl:text>female</xsl:text>

      </gender>
    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
