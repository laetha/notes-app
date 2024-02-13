<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="race">
    <xsl:copy>
      <xsl:apply-templates select="title|raceSize|raceSpeed|raceAbility|raceSpellAbility|raceProficiency"/>
      <xsl:element name="type">
        <xsl:text>race</xsl:text>
      </xsl:element>
        <raceTraits>
        <xsl:for-each select="trait">
            <xsl:value-of select="name" />
            <xsl:text> &#xa;</xsl:text>
            <xsl:for-each select="text">
            <xsl:value-of select="."/>
            <xsl:text>&#xa;&#xa;</xsl:text>
          </xsl:for-each>
        </xsl:for-each>
      </raceTraits>
    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
