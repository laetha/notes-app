<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="subclass">
    <xsl:copy>
      <xsl:apply-templates select="name|hd|saves|source|proficiency|spellAbility|numSkills|class"/>

      <multiclass>
      <xsl:for-each select="multiclass">
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
    </multiclass>

      <xsl:for-each select="lvlskill">
        <xsl:variable name="pos" select="position()"/>
        <xsl:element name="lvlskill{$pos}name">
          <xsl:value-of select="name" />
        </xsl:element>
        <xsl:element name="lvlskill{$pos}text">
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
