<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="class">
    <xsl:copy>
      <xsl:apply-templates select="name|hd|proficiency|spellAbility|numSkills"/>
        <autolevel>
        <xsl:for-each select="autolevel">
            <xsl:value-of select="name" />
            <xsl:text> &#xa;</xsl:text>
            <xsl:for-each select="text">
                <xsl:value-of select="."/>
                   <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                   <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                   <xsl:text>&#xa;</xsl:text>

            </xsl:for-each>
            <xsl:text>&#xa;</xsl:text>
        </xsl:for-each>
      </autolevel>
    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
