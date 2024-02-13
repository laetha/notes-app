<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="classtable">
    <xsl:copy>
      <xsl:apply-templates select="name|class|level|proficiency|cantrips|known|resource|feature|spelllvl1|spelllvl2|spelllvl3|spelllvl4|spelllvl5|spelllvl6|spelllvl7|spelllvl8|spelllvl9"/>

    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
